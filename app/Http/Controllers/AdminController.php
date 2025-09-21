<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\User;
use App\Models\UserPlan;
use App\Models\Vehicle;
use App\Models\Transaction;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function adminTampilDashboard()  
    {
        $adminStats = DB::table('users')->join('vehicles', 'users.id', '=', 'vehicles.user_id')->where('users.role', '!=', 'admin')
            ->select(DB::raw('COUNT(DISTINCT users.id) as jumlah_user'))
            ->selectRaw('(SELECT COUNT(*) FROM vehicles WHERE mod_status = "approve") as jumlah_iklan_approved')
            ->selectRaw('(SELECT COUNT(*) FROM vehicles WHERE mod_status = "waiting") as jumlah_iklan_menunggu')
            ->first();

        $recentTransactions = Transaction::with(['user', 'plan']) 
            ->where('status', 'success') 
            ->latest()                   
            ->take(5)                   
            ->get();

        $monthlyRevenue = Transaction::where('status', 'success')
            ->whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', Carbon::now()->month)
            ->sum('amount');
        // dd($adminStats);
        return view('admin.dashboard', compact('adminStats', 'recentTransactions', 'monthlyRevenue'));
    }
    public function adminTampilModerasi()
    {
        $modDatas = Vehicle::with(['user', 'photos'])
            ->whereHas('user', fn(Builder  $q) => $q->where('role', '!=', 'admin'))
            ->where('mod_status', 'waiting')->get();
        $modCounts = count($modDatas);
        return view('admin.moderasi', compact('modDatas', 'modCounts'));
    }

    public function adminAturModerasi($decision, $id)
    {
        $vehicleData = Vehicle::findOrFail($id);
        if ($vehicleData && $decision == "approve") {
            $vehicleData->status = 'active';
            $vehicleData->mod_status = 'approve';
            $vehicleData->save();
            return redirect('/admin/moderasi')->with(['status' => $vehicleData->type . " " . $vehicleData->brand . " " . $vehicleData->model . " Telah Disetujui"]);
        }
        $vehicleData->mod_status = 'reject';
        $vehicleData->save();
        return redirect('/admin/moderasi')->with(['status' => $vehicleData->type . " " . $vehicleData->brand . " " . $vehicleData->model . " Telah Ditolak"]);
    }

    public function adminTampilPaket()
    {
        $paketDatas = Plan::all()->sortBy('price')->values();
        return view('admin.paket', compact('paketDatas'));
    }

    public function adminAturPaket(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'price' => 'nullable|string',
            'quota_ads' => 'required|string|max:2',
            'duration_days' => 'nullable|string|max:2',
            'description' => 'required|string',
        ]);
        Plan::create([
            'name' => $request->name,
            'price' => $request->price ?? null,
            'quota_ads' => $request->quota_ads,
            'duration_days' => $request->duration_days ?? null,
            'description' => $request->description
        ]);
        return redirect('/admin/paket')->with(['status' => "Paket Berhasil Ditambahkan"]);
    }

    public function adminEditPaket(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'price' => 'nullable|string',
            'quota_ads' => 'required|string|max:2',
            'duration_days' => 'nullable|string|max:2',
            'description' => 'required|string',
        ]);
        $planData = Plan::findOrFail($id);
        $planData->name = $request->name;
        $planData->price = $request->price ?? null;
        $planData->quota_ads = $request->quota_ads;
        $planData->duration_days = $request->duration_days ?? null;
        $planData->description = $request->description;
        $planData->save();
        return redirect('/admin/paket')->with(['status' => "Paket " . $planData->name . " Berhasil Diperbarui"]);
    }
    public function adminTampilPengguna()
    {
        $userDatas = User::with(['vehicles' => function ($query) {
            $query->where('mod_status', 'approve');
        }])
            ->withCount(['vehicles as approved_vehicles_count' => function ($query) {
                $query->where('mod_status', 'approve');
            }])->orderBy('role', 'DESC')->get();
        // dd($userDatas);
        return view('admin.pengguna', compact('userDatas'));
    }

    public function adminTampilTransaksi()
    {
        $transactions = Transaction::with(['user', 'plan'])
            ->orderByRaw("FIELD(status, 'pending', 'success', 'failed')")
            ->latest()->get();
        return view('admin.transaksi', compact('transactions'));
    }

    public function adminUpdateStatusTransaksi(Request $request, Transaction $transaction)
    {
        $request->validate(['status' => 'required|in:success,failed']);

        $transaction->status = $request->status;
        $transaction->save();

        // Jika pembayaran sukses, aktifkan atau perbarui paket user
        if ($request->status == 'success') {
            $plan = $transaction->plan;
            $user = $transaction->user;
            $endDate = $plan->duration_days ? now()->addDays($plan->duration_days) : null;

            UserPlan::updateOrCreate(
                ['user_id' => $user->id], // Cari berdasarkan user_id
                [
                    'plan_id' => $plan->id,
                    'start_date' => now(),
                    'end_date' => $endDate,
                    'status' => 'active'
                ]
            );
            // ✅ Unlock vehicles based on new plan quota
            $allowedQuota = $plan->quota_ads ?? 1; // default to 1 if null (Free plan)

            // Get all vehicles ordered by created_at DESC (newer first)
            $vehicles = Vehicle::where('user_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->get();

            // Take only as many as allowed by quota
            $allowedVehicles = $vehicles->take($allowedQuota)->pluck('id');
            $lockedVehicles  = $vehicles->skip($allowedQuota)->pluck('id');

            // Unlock allowed vehicles
            if ($allowedVehicles->isNotEmpty()) {
                Vehicle::whereIn('id', $allowedVehicles)
                    ->where('status', '=', 'locked')
                    ->where('mod_status', '=', 'locked')
                    ->update([
                        'mod_status' => 'approve',
                        'status' => 'active'
                    ]);
            }

            // Keep excess vehicles locked (just to be sure)
            if ($lockedVehicles->isNotEmpty()) {
                Vehicle::whereIn('id', $lockedVehicles)
                    ->where('status', '!=', 'locked')
                    ->where('mod_status', '!=', 'locked')
                    ->update([
                        'mod_status' => 'locked',
                        'status' => 'locked'
                    ]);
            }
        }
        return back()->with('status', 'Status transaksi untuk invoice ' . $transaction->invoice_number . ' berhasil diperbarui.');
    }

    public function getChartData()
    {
        $monthlyData = Transaction::select(
                DB::raw('YEAR(created_at) as year'),
                DB::raw('MONTH(created_at) as month'),
                DB::raw('SUM(amount) as total')
            )
            ->where('status', 'success')
            ->where('created_at', '>=', Carbon::now()->subMonths(5)->startOfMonth()) // Ambil data 6 bulan terakhir
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

        // Format data untuk Chart.js
        $labels = [];
        $data = [];
        $date = Carbon::now()->subMonths(5)->startOfMonth();

        for ($i = 0; $i < 6; $i++) {
            $monthData = $monthlyData->first(function ($item) use ($date) {
                return $item->year == $date->year && $item->month == $date->month;
            });
            
            // Tambahkan nama bulan ke label
            $labels[] = $date->translatedFormat('F'); // Format nama bulan dalam Bahasa Indonesia
            // Tambahkan total pendapatan, atau 0 jika tidak ada
            $data[] = $monthData ? $monthData->total : 0;
            
            $date->addMonth();
        }

        return response()->json([
            'labels' => $labels,
            'data' => $data,
        ]);
    }
}
