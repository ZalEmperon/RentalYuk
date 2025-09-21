<?php

use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
Route::post('/vehicles/{vehicle}/increment-view', function (Vehicle $vehicle) {
    $vehicle->increment('view_count');
    return response()->json(['views' => $vehicle->views]);
});
Route::get('/admin/chart-data', [AdminController::class, 'getChartData']);