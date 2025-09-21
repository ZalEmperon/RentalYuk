<?php

use App\Models\UserPlan;
use App\Models\Vehicle;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schedule;
use Illuminate\Support\Facades\Log;

Schedule::call(function () {
    UserPlan::whereNotNull('end_date')
        ->where('end_date', '<', now())
        ->update(['plan_id' => 1, 'end_date' => null]);

    $excessUsers = DB::table('users')
        ->join('user_plans', 'users.id', '=', 'user_plans.user_id')
        ->join('plans', 'user_plans.plan_id', '=', 'plans.id')
        ->join('vehicles', 'users.id', '=', 'vehicles.user_id')
        ->select('users.id', 'plans.quota_ads', 'plans.name as nama_paket', DB::raw('COUNT(vehicles.id) as total_vehicles'))
        ->groupBy('users.id', 'plans.quota_ads', 'plans.name')
        ->havingRaw('COUNT(vehicles.id) > plans.quota_ads')
        ->get();

    foreach ($excessUsers as $user) {
        $vehicleIds = Vehicle::where('user_id', $user->id)
            ->orderBy('id', 'DESC')
            ->pluck('id');

        $excessVehicleIds = $vehicleIds->slice($user->quota_ads);

        if ($excessVehicleIds->isNotEmpty()) {
            Vehicle::whereIn('id', $excessVehicleIds)
                ->where('status', '!=', 'locked')
                ->where('mod_status', '!=', 'locked')
                ->update([
                    'mod_status' => 'locked',
                    'status' => 'locked'
                ]);
        }
        Log::info(count($excessVehicleIds) .' iklan anda telah dikunci karena kuota Paket ' . $user->nama_paket . ' telah Habis.');
    }
})->everySixHours();
