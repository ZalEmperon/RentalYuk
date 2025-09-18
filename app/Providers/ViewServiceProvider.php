<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Bagikan data paket aktif ke navbar owner setiap kali dimuat
        View::composer('owner.components.navbar', function ($view) {
            $planName = null;
            if (Auth::check() && Auth::user()->role === 'owner') {
                // Mengambil nama paket melalui relasi: User -> UserPlan -> Plan
                $planName = Auth::user()->userPlans?->plan?->name;
            }
            // Kirim variabel $currentPlanName ke view. Jika tidak ada, defaultnya 'Basic'.
            $view->with('currentPlanName', $planName ?? 'Basic');
        });
    }
}