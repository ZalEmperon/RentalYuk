<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OwnerController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\ClientController;

Route::get('/', [ClientController::class, 'clientTampilHome']);
Route::get('/detail/{id}', [ClientController::class, 'clientTampilDetail']);
Route::get('/sewa-{type}-{city}', [ClientController::class, 'clientTampilPencarian']);

// Halaman/Fungsi yang bisa diakses jika belum masuk / login
Route::middleware('guest')->group(function () {
    // Halaman Login
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');
    // Halaman Register
    Route::get('/register', function () {
        return view('auth.register');
    });
    // Fungsi Proses Login
    Route::post('/login', [AuthController::class, 'userLogin']);
    //Fungsi Proses Register
    Route::post('/register', [AuthController::class, 'userRegister']);

    // Halaman Forgot Password
    Route::get('/forgot-password', function () {
        return view('auth.reset.forgot-password');
    })->name('password.request');
    // Fungsi Proses Forgot Password
    Route::post('/forgot-password', [AuthController::class, 'sendEmailForgotPassword'])->name('password.email');
    // Halaman Reset/Ganti Password
    Route::get('/reset-password/{token}', function (string $token) {
        return view('auth.reset.reset', ['token' => $token]);
    })->middleware('guest')->name('password.reset');
    // Fungsi Proses Reset Password
    Route::post('/reset-password', [AuthController::class, 'resetPassword'])->middleware('guest')->name('password.update');
});

// Halaman/Fungsi yang bisa diakses jika sudah masuk / login
Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [AuthController::class, 'userLogout'])->name('logout');
    // Khusus Sudah Login tapi belum verifikasi
    Route::middleware('unverified')->group(function () {
        // Fungsi Verifikasi Email Register
        Route::prefix('email')->group(function () {
            // Untuk menampilkan pemberitahuan bahwa harus mengklik link verifikasi di email yang dikirimkan Laravel setelah pendaftaran.
            Route::get('/verify', function () {
                return view('auth.verify');
            })->name('verification.notice');

            // untuk menangani permintaan saat user mengklik link verifikasi email di email.
            Route::get('/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
                $request->fulfill();
                return redirect('/owner/pricing')->with(['status' => 'Akun Berhasil Diverifikasi, Selamat Beriklan...']);
            })->middleware(['signed'])->name('verification.verify');

            // untuk resend link verifikasi jika link verifikasi tidak dapat / hilang.
            Route::post('/verification-notification', function (Request $request) {
                $request->user()->sendEmailVerificationNotification();
                return back()->with('message', 'Verification link sent!');
            })->middleware(['throttle:4,1'])->name('verification.send');
        });
    });
    // Khusus Sudah Login dan verifikasi
    Route::middleware('verified')->group(function () {
        // Khusus role owner (Pemilik)
        Route::prefix('owner')->middleware('role:owner')->group(function () {
            Route::get('/riwayat-transaksi', [OwnerController::class, 'ownerTampilRiwayatTransaksi'])->name('owner.transaksi.riwayat');
            Route::get('/pembayaran/{transaction:invoice_number}', [OwnerController::class, 'ownerTampilPembayaran'])->name('owner.pembayaran.show');
            Route::post('/pembayaran/{transaction:invoice_number}/upload', [OwnerController::class, 'ownerUploadBukti'])->name('owner.pembayaran.upload');
            Route::post('/paket-saya/pilih', [OwnerController::class, 'ownerPilihPaket'])->name('owner.paket.pilih');
            Route::get('/pricing', [OwnerController::class, 'ownerTampilPaket']);
            // Route::post('/pricing', [OwnerController::class, 'ownerAturPaket']);
            Route::post('/paket-saya/pilih', [OwnerController::class, 'ownerPilihPaket'])->name('owner.paket.pilih');
            Route::get('/paket-saya', [OwnerController::class, 'ownerTampilPerbandinganPaket'])->name('owner.paket.show');
            Route::middleware('planless')->group(function () {
                // Route::get('/dashboard', [OwnerController::class, 'ownerTampilDashboard']);
                Route::get('/dashboard', [OwnerController::class, 'ownerTampilDashboard'])->name('owner.dashboard');
                Route::put('/ad-switch/{id}', [OwnerController::class, 'ownerStatusIklan']);
                Route::put('/ad-resubmit/{id}', [OwnerController::class, 'ownerResubmitIklan']);

                Route::get('/form-iklan', [OwnerController::class, 'ownerTampilTambahIklan']);
                Route::post('/form-iklan', [OwnerController::class, 'ownerTambahIklan']);
                Route::get('/form-iklan/edit/{id}', [OwnerController::class, 'ownerTampilEditIklan']);
                Route::put('/form-iklan/edit/{id}', [OwnerController::class, 'ownerEditIklan']);
                Route::delete('/form-iklan/delete/{id}', [OwnerController::class, 'ownerHapusIklan']);

                Route::get('/pengaturan', [OwnerController::class, 'ownerTampilProfil']);
                Route::put('/pengaturan', [OwnerController::class, 'ownerAturProfil']);
                Route::put('/pengaturan/pass', [OwnerController::class, 'ownerAturPass']);
            });
        });
        // Khusus role Admin
        Route::prefix('admin')->middleware('role:admin')->group(function () {
            Route::get('/dashboard', [AdminController::class, 'adminTampilDashboard']);

            Route::get('/moderasi', [AdminController::class, 'adminTampilModerasi']);
            Route::put('/moderasi/{decision}-{id}', [AdminController::class, 'adminAturModerasi']);

            Route::get('/transaksi/{$id}', [AdminController::class, 'ownerTampilTransaksi']);
            Route::post('/transaksi/{$id}', [AdminController::class, 'ownerTampilTransaksi']);

            Route::get('/paket', [AdminController::class, 'adminTampilPaket']);
            Route::post('/paket', [AdminController::class, 'adminAturPaket']);
            Route::put('/paket/{id}', [AdminController::class, 'adminEditPaket']);

            Route::get('/transaksi', [AdminController::class, 'adminTampilTransaksi'])->name('admin.transaksi.index');
            Route::put('/transaksi/{transaction}/update-status', [AdminController::class, 'adminUpdateStatusTransaksi'])->name('admin.transaksi.update');
            Route::get('/userlist', [AdminController::class, 'adminTampilPengguna']);
        });
    });
});
