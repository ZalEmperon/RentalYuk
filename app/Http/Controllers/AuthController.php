<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    /**
     * Melakukan Proses Pendaftaran akun / Register pengguna
     *
     * @return void
     */
    public function userRegister(Request $request)
    {
        $validated = $request->validate(
            [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'phone' => 'required|string|max:20|unique:users',
                'password' => 'required|string|min:8|confirmed',
            ],
            [
                'name.required' => 'Nama wajib diisi.',
                'name.string'   => 'Nama harus berupa teks.',

                'email.required' => 'Email wajib diisi.',
                'email.string'   => 'Email harus berupa teks.',
                'email.email'    => 'Format email tidak valid.',
                'email.unique'   => 'Email ini sudah terdaftar.',

                'phone.string' => 'Nomor telepon harus berupa angka.',
                'phone.max'    => 'Nomor telepon maksimal 20 karakter.',

                'password.required'  => 'Kata sandi wajib diisi.',
                'password.min'       => 'Kata sandi minimal 8 karakter.',
                'password.confirmed' => 'Konfirmasi kata sandi tidak cocok.',
            ]
        );

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'password' => Hash::make($validated['password']),
            'role' => 'owner', 
        ]);
        Auth::login($user);
        event(new Registered($user));
        $plan = DB::table('plans')
            ->join('user_plans', 'user_plans.plan_id', '=', 'plans.id')
            ->where('user_plans.user_id', $user->id)
            ->select('plans.name')->first();
        if($plan){
            session(['plan' => $plan->name]);
        }
        if (!is_null($user->email_verified_at)) {
            return redirect('/owner/dashboard');
        }
        return redirect('/email/verify');
    }

    /**
     * Melakukan Proses Masuk / Login pengguna
     *
     * @return void
     */
    public function userLogin(Request $request)
    {
        $request->validate(
            [
                'email'    => 'required|email',
                'password' => 'required|string',
            ],
            [
                'email.required' => 'Email wajib diisi.',
                'email.email' => 'Format email tidak valid.',
                'password.required' => 'Password wajib diisi.',
                'password.min' => 'Password minimal 8 karakter.',
            ]
        );
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();
            $request->session()->regenerateToken();
            $plan = DB::table('plans')
                ->join('user_plans', 'user_plans.plan_id', '=', 'plans.id')
                ->where('user_plans.user_id', Auth::user()->id)
                ->select('plans.name')->first();
            if($plan){
                session(['plan' => $plan->name]);
            }
            if (!is_null(Auth::user()->email_verified_at)) {
                if (Auth::user()->role === 'owner') {
                    return redirect('/owner/dashboard');
                } elseif (Auth::user()->role === 'admin') {
                    return redirect('/admin/dashboard');
                }
            }
            return redirect('/email/verify');
        }
        return back()->withErrors(['status' => "Kesalahan Pada Email atau Password"]);
    }

    public function userLogout(Request $request)
    {
        Auth::logout();

        // Clear all session data
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Forget "remember me" cookie
        Cookie::queue(Cookie::forget(Auth::getRecallerName()));

        return redirect('/login');
    }
    public function sendEmailForgotPassword(Request $request)
    {
        $request->validate(['email' => 'required|email'], [
            'email.required' => 'Email wajib diisi.',
            'email.string'   => 'Email harus berupa teks.',
            'email.email'    => 'Format email tidak valid.',
        ]);
        $status = Password::sendResetLink(
            $request->only('email')
        );
        return $status === Password::ResetLinkSent
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => "Email tidak dapat ditemukan / tidak valid"]);
    }
    public function resetPassword(Request $request)
    {
        $request->validate(
            [
                'token' => 'required',
                'email' => 'required|email',
                'password' => 'required|min:8|confirmed',
            ],
            [
                'password.required'  => 'Kata sandi wajib diisi.',
                'password.min'       => 'Kata sandi minimal 8 karakter.',
                'password.confirmed' => 'Konfirmasi kata sandi tidak cocok.',
            ]
        );
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
                $user->save();
                event(new PasswordReset($user));
            }
        );
        return $status === Password::PasswordReset
            ? redirect("/login")->with('status', __($status))
            : back()->withErrors(['email' => "Email tidak dapat ditemukan / tidak valid"]);
    }
}
