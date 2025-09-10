<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\User;
use App\Models\UserPlan;
use App\Models\Vehicle;
use App\Models\VehiclePhoto;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class OwnerController extends Controller
{
    public function ownerTampilDashboard()
    {
        $ownerQuotas = DB::table('user_plans')->join('plans', 'plans.id', '=', 'user_plans.plan_id')
            ->leftJoin('vehicles', 'user_plans.user_id', '=', 'vehicles.user_id')->where('user_plans.user_id', Auth::user()->id)
            ->select('plans.quota_ads', DB::raw('COUNT(vehicles.id) as jumlah_iklan'))->groupBy('plans.quota_ads')->first();
        $ownerDatas = DB::table('vehicles')->where('user_id', Auth::user()->id)
            ->select('id', 'brand', 'model', 'city', 'price_per_day', 'status', 'mod_status', 'created_at')
            ->orderBy('created_at', 'DESC')->get();
        // dd($ownerQuotas, $ownerDatas);
        return view('owner.dashboard', compact('ownerQuotas', 'ownerDatas'));
    }
    public function ownerStatusIklan($id)
    {
        $adData = Vehicle::findOrFail($id);
        $adData->status = $adData->status == 'active' ? 'inactive' : 'active';
        $adData->save();
        return redirect('/owner/dashboard')
            ->with(['status' => ''. $adData->brand . ' ' . $adData->model . ' Telah ' . ($adData->status == 'active' ? 'diaktifkan, iklan ditampilkan' : 'dinonaktifkan, iklan tidak ditampilkan')]);
    }
    public function ownerAturPaket(Request $request)
    {
        $request->validate(
            [
                'plan_id' => 'required|string',
            ]
        );
        $startDate = Carbon::now();
        $endDate = null;
        $planData = Plan::where('id', $request->plan_id)->first();
        if ($planData && $planData->duration_days !== null) {
            $endDate = $startDate->copy()->addDays($planData->duration_days);
        }
        UserPlan::create([
            'user_id' => Auth::user()->id,
            'plan_id' => $request->plan_id,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'status' => 'active',
        ]);
        $plan = DB::table('plans')
            ->join('user_plans', 'user_plans.plan_id', '=', 'plans.id')
            ->where('user_plans.user_id', Auth::user()->id)
            ->select('plans.name')->first();
        session(['plan' => $plan->name]);
        return redirect('/owner/dashboard')->with(['status' => 'Persiapan Periklanan Sudah Siap']);
    }

    public function ownerTambahIklan(Request $request)
    {
        $publicStorageLink = public_path('storage');
        if (!is_link($publicStorageLink)) {
            Artisan::call('storage:link');
        }
        if (!Storage::disk('public')->exists('photo')) {
            Storage::disk('public')->makeDirectory('photo');
        }
        if (!Storage::disk('public')->exists('photo/mobil')) {
            Storage::disk('public')->makeDirectory('photo/mobil');
        }
        if (!Storage::disk('public')->exists('photo/motor')) {
            Storage::disk('public')->makeDirectory('photo/motor');
        }
        if (!Storage::disk('public')->exists('photo/other')) {
            Storage::disk('public')->makeDirectory('photo/other');
        }
        // dd($request);
        $request->validate([
            'type' => 'required|string',
            'brand' => 'required|string',
            'model' => 'required|string',
            'year' => 'required|string',
            'description' => 'required|string',
            'price_per_day' => 'required|string',
            'city' => 'required|string',
            'address' => 'required|string',
            'photo.*' => 'nullable|image|mimes:jpeg,png,jpg|max:4096',
        ]);
        $userPlanCheck = DB::table('user_plans')->where('user_id', Auth::user()->id)->select('plan_id')->first();
        $is_premium = $userPlanCheck && $userPlanCheck->plan_id > 1 ? 1 : 0;
        $kendaraan = Vehicle::create([
            'user_id' => Auth::user()->id,
            'type' => strtolower($request->type),
            'brand' => $request->brand,
            'model' => $request->model,
            'year' => $request->year,
            'description' => $request->description,
            'price_per_day' => $request->price_per_day,
            'city' => $request->city,
            'address' => $request->address,
            'status' => 'inactive',
            'mod_status' => 'waiting',
            'is_premium' => $is_premium,
        ]);
        if ($request->hasFile('photo')) {
            foreach ($request->file('photo') as $key => $image) {
                $filename = $kendaraan->type . time() . '_' . Str::random(5) . '.' . $image->extension();
                if ($kendaraan->type == 'mobil' || $kendaraan->type == 'motor') {
                    $image->storeAs('photo/' . $kendaraan->type, $filename, 'public');
                } else {
                    $image->storeAs('photo/other', $filename, 'public');
                }
                VehiclePhoto::create([
                    'vehicle_id' => $kendaraan->id,
                    'photo_url' => $filename,
                ]);
                if ($key === 0) {
                    $kendaraan->update(['main_photo_url' => $filename]);
                }
            }
        }
        return redirect('/owner/dashboard')->with(['status' => 'Iklan Anda berhasil ditambahkan dan sedang menunggu persetujuan dari Admin']);
    }

    public function ownerTampilEditIklan(Request $request, $id)
    {
        $vehicleDatas = Vehicle::with('photos')
            ->where('user_id', Auth::user()->id)
            ->where('id', $id)
            ->first();
        // dd($vehicleDatas);
        return view('owner.form_iklan_edit', compact('vehicleDatas'));
    }

    public function ownerEditIklan(Request $request, $id)
    {
        $publicStorageLink = public_path('storage');
        if (!is_link($publicStorageLink)) {
            Artisan::call('storage:link');
        }
        if (!Storage::disk('public')->exists('photo')) {
            Storage::disk('public')->makeDirectory('photo');
        }
        if (!Storage::disk('public')->exists('photo/mobil')) {
            Storage::disk('public')->makeDirectory('photo/mobil');
        }
        if (!Storage::disk('public')->exists('photo/motor')) {
            Storage::disk('public')->makeDirectory('photo/motor');
        }
        if (!Storage::disk('public')->exists('photo/other')) {
            Storage::disk('public')->makeDirectory('photo/other');
        }

        // dd($request);
        $request->validate([
            'type' => 'required|string',
            'brand' => 'required|string',
            'model' => 'required|string',
            'year' => 'required|string',
            'description' => 'required|string',
            'price_per_day' => 'required|string',
            'city' => 'required|string',
            'address' => 'required|string',
            'photo.*' => 'nullable|image|mimes:jpeg,png,jpg|max:4096',
            'deleted_photos' => 'nullable|string',
        ]);
        $kendaraan = Vehicle::where('user_id', Auth::user()->id)->where('id', $id)->first();
        if ($request->deleted_photos) {
            $ids = json_decode($request->deleted_photos, true);
            foreach ($ids as $id) {
                $photo = VehiclePhoto::find($id);
                // dd($photo);
                if ($photo) {
                    Storage::disk('public')->delete('photo/' . $kendaraan->type . '/' . $photo->photo_url);
                    $photo->delete();
                }
            }
        }
        $kendaraan->type = strtolower($request->type);
        $kendaraan->brand = $request->brand;
        $kendaraan->model = $request->model;
        $kendaraan->year = $request->year;
        $kendaraan->description = $request->description;
        $kendaraan->price_per_day = $request->price_per_day;
        $kendaraan->city = $request->city;
        $kendaraan->address = $request->address;
        $kendaraan->save();
        if ($request->hasFile('photo')) {
            foreach ($request->file('photo') as $key => $image) {
                $filename = $kendaraan->type . time() . '_' . Str::random(5) . '.' . $image->extension();
                if ($kendaraan->type == 'mobil') {
                    $image->storeAs('photo/mobil', $filename, 'public');
                } elseif ($kendaraan->type == 'motor') {
                    $image->storeAs('photo/motor', $filename, 'public');
                } else {
                    $image->storeAs('photo/other', $filename, 'public');
                }
                VehiclePhoto::create([
                    'vehicle_id' => $kendaraan->id,
                    'photo_url' => $filename,
                ]);
                if ($key === 0) {
                    $kendaraan->update(['main_photo_url' => $filename]);
                }
            }
        }
        return redirect('/owner/dashboard')->with(['status' => 'Iklan Berhasil Diperbarui']);
    }

    public function ownerHapusIklan(Request $request, $id)
    {
        $kendaraan = Vehicle::where('user_id', Auth::user()->id)->where('id', $id)->first();
        $photo = VehiclePhoto::find($kendaraan->id);
        if ($photo) {
            Storage::disk('public')->delete('photo/' . $kendaraan->type . '/' . $photo->photo_url);
            $photo->delete();
        }
        if ($kendaraan) {
            $kendaraan->delete();
        }
        return redirect('/owner/dashboard')->with(['status' => 'Iklan Berhasil Dihapus']);
    }

    public function ownerTampilProfil()
    {
        $userData = User::where('id', Auth::user()->id)->first();
        return view('owner.pengaturan', compact('userData'));
    }

    public function ownerAturProfil(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|string|max:255',
                'phone' => 'nullable|string|max:20',

            ],
            [
                'name.required' => 'Nama wajib diisi.',
                'name.string'   => 'Nama harus berupa teks.',
                'phone.string' => 'Nomor telepon harus berupa angka.',
                'phone.max'    => 'Nomor telepon maksimal 20 karakter.',
            ]
        );
        $userData = User::findOrFail(Auth::user()->id);
        $userData->name = $request->name;
        $userData->phone = $request->phone;
        $userData->save();
        return redirect('/owner/pengaturan')->with(['status' => 'Data Profil Berhasil Diperbarui']);
    }

    public function ownerAturPass(Request $request)
    {
        $request->validate(
            [
                'password' => 'required|string|min:8|confirmed',
            ],
            [
                'password.required'  => 'Kata sandi wajib diisi.',
                'password.min'       => 'Kata sandi minimal 8 karakter.',
                'password.confirmed' => 'Konfirmasi kata sandi tidak cocok.',
            ]
        );
        $userData = User::findOrFail(Auth::user()->id);
        $userData->password = Hash::make($request->password);
        $userData->save();
        return redirect('/owner/pengaturan')->with(['status' => 'Password Pengguna Berhasil Diperbarui']);
    }
}
