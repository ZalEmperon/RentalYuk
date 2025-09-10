<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function userTampilHome()
    {
        $mobilDatas = Vehicle::with(['photos' => function ($q) {
            $q->select('photo_url')->limit(1);}])
        ->where('type', 'mobil')
        ->select('id', 'brand', 'type', 'model', 'price_per_day')
        ->get();

    }
}
