<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Transaction;
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
        $ownerQuotas = DB::table('user_plans')
            ->join('plans', 'plans.id', '=', 'user_plans.plan_id')
            ->leftJoin('vehicles', 'user_plans.user_id', '=', 'vehicles.user_id')
            ->where('user_plans.user_id', Auth::user()->id)
            ->select('plans.quota_ads', DB::raw('COUNT(vehicles.id) as jumlah_iklan'))
            ->groupBy('plans.quota_ads')
            ->first();
        $ownerDatas = DB::table('vehicles')
            ->where('user_id', Auth::user()->id)
            ->select('id', 'brand', 'model', 'city', 'price_per_day', 'status', 'mod_status', 'created_at')
            ->orderBy('created_at', 'DESC')
            ->get();
        return view('owner.dashboard', compact('ownerQuotas', 'ownerDatas'));
    }

    public function ownerStatusIklan($id)
    {
        $adData = Vehicle::findOrFail($id);
        $adData->status = $adData->status == 'active' ? 'inactive' : 'active';
        $adData->save();
        return redirect('/owner/dashboard')->with(['status' => '' . $adData->brand . ' ' . $adData->model . ' Telah ' . ($adData->status == 'active' ? 'diaktifkan, iklan ditampilkan' : 'dinonaktifkan, iklan tidak ditampilkan')]);
    }

    public function ownerResubmitIklan($id)
    {
        $adData = Vehicle::findOrFail($id);
        $adData->mod_status = 'waiting';
        $adData->save();
        return redirect('/owner/dashboard')->with(['status' => '' . $adData->brand . ' ' . $adData->model . ' Telah diajukan kembali dan sedang menunggu persetujuan dari Admin']);
    }

    public function ownerTampilPaket()
    {
        $planDatas = Plan::all();
        $userPlanCheck = UserPlan::where('user_id', Auth::user()->id)
            ->select('plan_id')
            ->first();
        $currentPlanId = $userPlanCheck->plan_id ?? null;
        return view('owner.pricing', compact('planDatas', 'currentPlanId'));
    }

    // public function ownerAturPaket(Request $request)
    // {
    //     $request->validate(['plan_id' => 'required|exists:plans,id']);
    //     $plan = Plan::findOrFail($request->plan_id);
    //     $user = Auth::user();

    //     if (is_null($plan->price) || $plan->price == 0) {
    //         // Logika untuk paket gratis (tetap sama)
    //         UserPlan::updateOrCreate(['user_id' => $user->id], [
    //             'plan_id' => $plan->id, 'start_date' => Carbon::now(),
    //             'end_date' => null, 'status' => 'active',
    //         ]);
    //         return redirect('/owner/dashboard')->with('status', 'Paket Gratis Anda telah diaktifkan!');
    //     } else {
    //         // LOGIKA BARU UNTUK PAKET BERBAYAR
    //         $today = Carbon::now()->format('Ymd');
    //         $lastTransaction = Transaction::where('invoice_number', 'like', "INV-{$today}-%")->count();
    //         $invoiceNumber = "INV-{$today}-" . str_pad($lastTransaction + 1, 4, '0', STR_PAD_LEFT);

    //         $transaction = Transaction::create([
    //             'invoice_number' => $invoiceNumber,
    //             'user_id' => $user->id,
    //             'plan_id' => $plan->id,
    //             'amount' => $plan->price,
    //             'status' => 'pending',
    //         ]);
    //         return redirect()->route('owner.pembayaran.show', $transaction->invoice_number);
    //     }
    // }

    public function ownerPilihPaket(Request $request)
    {
        $request->validate(['plan_id' => 'required|exists:plans,id']);

        $plan = Plan::findOrFail($request->plan_id);
        $user = Auth::user();

        // AMBIL DATA PAKET AKTIF PENGGUNA
        $currentActivePlan = UserPlan::with('plan')->where('user_id', $user->id)->where('status', 'active')->first();

        // Cek jika pengguna mencoba memilih paket gratis, padahal sudah punya paket berbayar yang aktif
        if ((is_null($plan->price) || $plan->price == 0) && $currentActivePlan && $currentActivePlan->plan->price > 0) {
            // Cek apakah masa aktif paket berbayar sudah habis
            // Jika end_date masih ada di masa depan atau NULL (selamanya), maka tolak downgrade
            if (is_null($currentActivePlan->end_date) || Carbon::parse($currentActivePlan->end_date)->isFuture()) {
                return back()->withErrors(['status' => 'Anda tidak dapat kembali ke paket Basic. Paket ' . $currentActivePlan->plan->name . ' Anda masih aktif.']);
            }
        }
        // ==========================================================

        // Logika jika paket yang dipilih GRATIS (dan pengguna memang berhak)
        if (is_null($plan->price) || $plan->price == 0) {
            UserPlan::updateOrCreate(['user_id' => $user->id], ['plan_id' => $plan->id, 'start_date' => now(), 'end_date' => null, 'status' => 'active']);
            // Perbarui session plan jika Anda masih menggunakannya
            session(['plan' => $plan->name]);
            return redirect()->route('owner.dashboard')->with('status', 'Paket Gratis Anda telah diaktifkan!');
        }

        // Logika jika paket yang dipilih BERBAYAR (membuat invoice/transaksi)
        // ... (kode untuk membuat invoice tetap sama) ...
        $today = now()->format('Ymd');
        $lastTransactionToday = Transaction::where('invoice_number', 'like', "INV-{$today}-%")
            ->latest('id')
            ->first();

        $nextSequence = 1;
        if ($lastTransactionToday) {
            $lastSequence = (int) substr($lastTransactionToday->invoice_number, -4);
            $nextSequence = $lastSequence + 1;
        }

        $invoiceNumber = "INV-{$today}-" . str_pad($nextSequence, 4, '0', STR_PAD_LEFT);

        $transaction = Transaction::create([
            'invoice_number' => $invoiceNumber,
            'user_id' => $user->id,
            'plan_id' => $plan->id,
            'amount' => $plan->price,
            'status' => 'pending',
        ]);

        return redirect()->route('owner.pembayaran.show', $transaction->invoice_number);
    }
    public function ownerTampilPembayaran(Transaction $transaction)
    {
        if ($transaction->user_id !== Auth::id()) {
            abort(403);
        }
        return view('owner.pembayaran', compact('transaction'));
    }

    public function ownerUploadBukti(Request $request, Transaction $transaction)
    {
        if ($transaction->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate(['proof' => 'required|image|mimes:jpg,jpeg,png|max:2048']);

        // Hapus bukti lama jika ada
        if ($transaction->proof_url) {
            Storage::disk('public')->delete($transaction->proof_url);
        }

        // Simpan bukti baru
        $path = $request->file('proof')->store('proofs', 'public');
        $transaction->proof_url = $path;
        $transaction->save();

        return back()->with('status', 'Bukti pembayaran berhasil diunggah. Mohon tunggu verifikasi Admin.');
    }

    public function ownerTampilRiwayatTransaksi()
    {
        $transactions = Transaction::with('plan')->where('user_id', Auth::id())->latest()->get();
        return view('owner.riwayat_transaksi', compact('transactions'));
    }

    public function ownerTampilTambahIklan()
    {
        // Validasi Kuota Owner
        $quotaValid = DB::table('user_plans')
            ->join('plans', 'user_plans.plan_id', '=', 'plans.id')
            ->join('vehicles', 'user_plans.user_id', '=', 'vehicles.user_id')
            ->where('user_plans.user_id', Auth::user()->id)
            ->select('plans.name', 'plans.quota_ads', DB::raw('COUNT(vehicles.id) as jumlah_iklan'))
            ->groupBy('plans.quota_ads', 'plans.name')
            ->first();
        if ($quotaValid && $quotaValid->jumlah_iklan >= $quotaValid->quota_ads) {
            return redirect('/owner/dashboard')->withErrors(['status' => 'Kuota iklan ' . $quotaValid->name . ' Anda sudah habis. Silakan upgrade ke paket yang lebih tinggi untuk memasang lebih banyak iklan.']);
        } else {
            return view('owner.form_iklan');
        }
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
        $mainPhotoStoredName = null;
        $request->validate([
            'type' => 'required|string',
            'brand' => 'required|string',
            'model' => 'required|string',
            'year' => 'required|string',
            'transmission' => 'required|string',
            'capacity' => 'required|integer|min:1',
            'fuel_type' => 'required|string',
            'description' => 'required|string',
            'price_per_day' => 'required|string',
            'city' => 'required|string',
            'main_photo_url' => 'string',
            'photo.*' => 'nullable|image|mimes:jpeg,png,jpg|max:4096',
        ]);
        $userPlanCheck = UserPlan::where('user_id', Auth::user()->id)
            ->select('plan_id')
            ->first();
        $is_premium = $userPlanCheck && $userPlanCheck->plan_id > 1 ? 1 : 0;
        $kendaraan = Vehicle::create([
            'user_id' => Auth::user()->id,
            'type' => strtolower($request->type),
            'brand' => $request->brand,
            'model' => $request->model,
            'year' => $request->year,
            'transmission' => $request->transmission,
            'capacity' => $request->capacity,
            'fuel_type' => $request->fuel_type,
            'view_count' => 0,
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
                if ($image->getClientOriginalName() === $request->main_photo_url) {
                    $mainPhotoStoredName = $filename;
                    // dd("NEMOOOOO". $mainPhotoStoredName, $filename);   
                }elseif($key == 0 && !$mainPhotoStoredName) {
                    $mainPhotoStoredName = $filename;
                    // dd("Pain". $mainPhotoStoredName, $filename);   
                }
            }
            $kendaraan->update(['main_photo_url' => $mainPhotoStoredName]);
            $kendaraan->save();
        }
        return redirect('/owner/dashboard')->with(['status' => 'Iklan Anda berhasil ditambahkan dan sedang menunggu persetujuan dari Admin']);
    }

    public function ownerTampilEditIklan(Request $request, $id)
    {
        $vehicleDatas = Vehicle::with('photos')
            ->where('user_id', Auth::user()->id)
            ->where('id', $id)
            ->first();
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
        $mainPhotoFilename = null;
        $request->validate([
            'type' => 'required|string',
            'brand' => 'required|string',
            'model' => 'required|string',
            'year' => 'required|string',
            // --- PENAMBAHAN VALIDASI ---
            'transmission' => 'required|string',
            'capacity' => 'required|integer|min:1',
            'fuel_type' => 'required|string',
            // --- AKHIR PENAMBAHAN ---
            'description' => 'required|string',
            'price_per_day' => 'required|string',
            'city' => 'required|string',
            'address' => 'required|string',
            'main_photo_url' => 'nullable|string',
            'photos.*' => 'nullable|image|mimes:jpeg,png,jpg|max:4096',
            'deleted_photos' => 'nullable|string',
        ]);

        $kendaraan = Vehicle::where('user_id', Auth::user()->id)
            ->where('id', $id)
            ->first();
        if ($request->deleted_photos) {
            $ids = json_decode($request->deleted_photos, true);
            foreach ($ids as $id) {
                $photo = VehiclePhoto::find($id);
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
        $kendaraan->transmission = $request->transmission;
        $kendaraan->capacity = $request->capacity;
        $kendaraan->fuel_type = $request->fuel_type;
        $kendaraan->description = $request->description;
        $kendaraan->price_per_day = $request->price_per_day;
        $kendaraan->city = $request->city;
        $kendaraan->address = $request->address;
        $kendaraan->save();

        if ($request->filled('deleted_photos')) {
            $idsToDelete = json_decode($request->deleted_photos, true);
            $photos = VehiclePhoto::whereIn('id', $idsToDelete)->where('vehicle_id', $kendaraan->id)->get();
            foreach ($photos as $photo) {
                Storage::disk('public')->delete('photo/' . $kendaraan->type . '/' . $photo->photo_url);
                $photo->delete();
            }
        }
        // Tambah foto detail baru
        // dd($mainPhotoFilename);
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $image) {
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
                if ($image->getClientOriginalName() === $request->main_photo_url) {
                    $mainPhotoFilename = $filename;
                }
            }
        }
        // SELALU PERBARUI FOTO UTAMA SETELAH SEMUA OPERASI FOTO
        if($mainPhotoFilename){
            $kendaraan->main_photo_url = $mainPhotoFilename;
        }elseif (!$mainPhotoFilename && $kendaraan->photos()->where('photo_url', $request->input('main_photo_url'))->exists()) {
            $mainPhotoFilename = $request->input('main_photo_url');
            $kendaraan->main_photo_url = $mainPhotoFilename;
        } 
        $kendaraan->save(); // Simpan perubahan terakhir pada main_photo_url
        return redirect()
            ->route('owner.dashboard')
            ->with(['status' => 'Iklan Berhasil Diperbarui']);
    }

    public function ownerHapusIklan(Request $request, $id)
    {
        $kendaraan = Vehicle::where('user_id', Auth::user()->id)
            ->where('id', $id)
            ->first();
        $photos = VehiclePhoto::where('vehicle_id', $kendaraan->id)->get();
        if ($photos->isNotEmpty()) {
            foreach ($photos as $photo) {
                Storage::disk('public')->delete('photo/' . $kendaraan->type . '/' . $photo->photo_url);
                $photo->delete();
            }
        }
        if ($kendaraan) {
            $kendaraan->delete();
        }
        return redirect('/owner/dashboard')->with(['status' => 'Iklan Berhasil Dihapus']);
    }

    public function ownerTampilTransaksi()
    {
        // $transaction = Transaction::with('plan')->findOrFail($id);
        // if ($transaction->user_id !== Auth::user()->id) {
        //     abort(403, 'Unauthorized');
        // }
        // return view('owner.pricing_detail', compact('transaction'));
        return view('owner.pricing_detail');
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
                'name.string' => 'Nama harus berupa teks.',
                'phone.string' => 'Nomor telepon harus berupa angka.',
                'phone.max' => 'Nomor telepon maksimal 20 karakter.',
            ],
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
                'password.required' => 'Kata sandi wajib diisi.',
                'password.min' => 'Kata sandi minimal 8 karakter.',
                'password.confirmed' => 'Konfirmasi kata sandi tidak cocok.',
            ],
        );
        $userData = User::findOrFail(Auth::user()->id);
        $userData->password = Hash::make($request->password);
        $userData->save();
        return redirect('/owner/pengaturan')->with(['status' => 'Password Pengguna Berhasil Diperbarui']);
    }
    public function ownerTampilPerbandinganPaket()
    {
        // Ambil semua data paket dari database, urutkan dari harga termurah
        $plans = Plan::orderBy('price', 'asc')->get();

        // Ambil detail lengkap paket yang sedang digunakan oleh owner saat ini
        $currentPlan = UserPlan::with('plan')
            ->where('user_id', Auth::user()->id)
            ->first();

        // Tentukan mana paket tertinggi (berdasarkan urutan harga)
        $highestPlan = $plans->last();

        // Kirim semua data yang dibutuhkan ke view
        return view('owner.perbandingan_paket', compact('plans', 'currentPlan', 'highestPlan'));
    }
}
