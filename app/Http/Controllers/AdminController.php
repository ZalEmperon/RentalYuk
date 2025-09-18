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
        $adminStats = DB::table('users')->join('vehicles', 'users.id', '=', 'vehicles.user_id')->where('users.role', '!=','admin')
        ->select(DB::raw('COUNT(users.id) as jumlah_user'))
        ->selectRaw('(SELECT COUNT(*) FROM vehicles WHERE mod_status = "approve") as jumlah_iklan_approved')
        ->selectRaw('(SELECT COUNT(*) FROM vehicles WHERE mod_status = "waiting") as jumlah_iklan_menunggu')
        ->first();
        return view('admin.dashboard', compact('adminStats'));
    }
    public function adminTampilModerasi()
    {   
        $modDatas = Vehicle::with(['user', 'photos'])
            ->whereHas('user', fn(Builder  $q) => $q->where('role', '!=', 'admin'))
            ->where('mod_status', 'waiting')->get();
        $modCounts = count($modDatas);
        return view('admin.moderasi', compact('modDatas', 'modCounts'));
    }
    
    public function adminAturModerasi($decision, $id) {
        $vehicleData = Vehicle::findOrFail($id);
        if($vehicleData && $decision == "approve"){
            $vehicleData->status = 'active';
            $vehicleData->mod_status = 'approve';
            $vehicleData->save();
            return redirect('/admin/moderasi')->with(['status' => $vehicleData->type ." ". $vehicleData->brand ." ". $vehicleData->model ." Telah Disetujui"]);
        }
        $vehicleData->mod_status = 'reject';
        $vehicleData->save();
        return redirect('/admin/moderasi')->with(['status' => $vehicleData->type ." ". $vehicleData->brand ." ". $vehicleData->model ." Telah Ditolak"]);
    }
    
    public function adminTampilPaket()
    {
        $paketDatas = Plan::all()->sortBy('price');
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
        return redirect('/admin/paket')->with(['status' => "Paket ". $planData->name. " Berhasil Diperbarui"]);
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

    public function adminVerifikasiTransaksi(Request $request, Transaction $transaction)
    {
        $request->validate(['status' => 'required|in:success,failed']);
        $transaction->status = $request->status;
        $transaction->save();

        // Jika pembayaran sukses, aktifkan paket user
        if ($request->status == 'success') {
            $plan = $transaction->plan;
            $user = $transaction->user;
            $startDate = Carbon::now();
            $endDate = $plan->duration_days ? $startDate->copy()->addDays($plan->duration_days) : null;

            UserPlan::updateOrCreate(['user_id' => $user->id], [
                'plan_id' => $plan->id, 'start_date' => $startDate,
                'end_date' => $endDate, 'status' => 'active',
            ]);
        }

        return back()->with('status', 'Status transaksi ' . $transaction->invoice_number . ' berhasil diperbarui.');
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
        }

        return back()->with('status', 'Status transaksi untuk invoice ' . $transaction->invoice_number . ' berhasil diperbarui.');
    }
}
