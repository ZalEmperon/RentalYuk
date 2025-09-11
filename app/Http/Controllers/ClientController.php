<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function clientTampilHome()
    {
        // Ambil 6 data kendaraan teratas yang aktif & disetujui
        $mobilDatas = Vehicle::with(['photos' => function ($q) {
            $q->select('vehicle_id', 'photo_url')->limit(1);
        }])
            ->where('type', 'mobil')
            ->select('id', 'brand', 'type', 'model', 'price_per_day', 'transmission', 'capacity')
            ->latest()->take(6)->get();

        $motorDatas = Vehicle::with(['photos' => function ($q) {
            $q->select('vehicle_id', 'photo_url')->limit(1);
        }])
            ->where('type', 'motor')
            ->select('id', 'brand', 'type', 'model', 'price_per_day', 'transmission', 'capacity')
            ->latest()->take(6)->get();
        return view('client.home', compact('mobilDatas', 'motorDatas'));
    }

    public function clientTampilDetail($id)
    {
        $vehicleData = Vehicle::with('photos')->where('id', $id)->first();
        return view('client.detail_kendaraan', compact('vehicleData'));
    }

    public function clientTampilPencarian(Request $request, $type, $city)
    {
        $vehicleDatas = Vehicle::query();
        $vehicleDatas->with(['photos' => function ($q) {
            $q->select('vehicle_id', 'photo_url')->limit(1);
        }]);
        if ($type != "kendaraan") {
            $vehicleDatas->where('type', $type);
        }
        if ($city != "semua") {
            $vehicleDatas->where('city', strtolower($city));
        }
        $vehicleDatas->select('id', 'brand', 'type', 'model', 'price_per_day', 'transmission', 'capacity')
            ->orderBy('is_premium', 'DESC')->get();
        return view('client.hasil_pencarian', compact('vehicleDatas'));
    }
}
