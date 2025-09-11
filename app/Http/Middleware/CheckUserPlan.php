<?php

namespace App\Http\Middleware;

use App\Models\UserPlan;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckUserPlan
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = UserPlan::where('user_id', Auth::user()->id)->first();
        if (!$user && Auth::user()->role === 'owner') {
            return redirect('/owner/pricing')->withErrors('status', 'Anda harus memilih paket terlebih dahulu.');
        }
        return $next($request);
    }
}
