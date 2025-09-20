<?php

use App\Models\UserPlan;
use App\Models\Vehicle;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schedule;
use Illuminate\Support\Facades\Log;

Schedule::call(function () {
    UserPlan::whereNotNull('end_date')
        ->where('end_date', '<', now())
        ->update(['plan_id' => 1]);
    $excessUsers = DB::table('users')
        ->join('user_plans', 'users.id', '=', 'user_plans.user_id')
        ->join('plans', 'user_plans.plan_id', '=', 'plans.id')
        ->join('vehicles', 'users.id', '=', 'vehicles.user_id')
        ->havingRaw('COUNT(vehicles.id) > plans.quota_ads')->select('users.id', 'plans.quota_ads')->get();

    foreach ($excessUsers as $user) {
        $vehicleIds = Vehicle::where('user_id', $user->id)->orderBy('id', 'ASC')->pluck('id');
        $excessVehicleIds = $vehicleIds->slice($user->quota_ads);
        if ($excessVehicleIds->isNotEmpty()) {
            Vehicle::whereIn('id', $excessVehicleIds)->update(['mod_status' => 'locked', 'status' => 'locked']);
        }
    }
})->everyTenSeconds();
