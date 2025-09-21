<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function clientTampilHome()
    {
        // Ambil 6 data mobil teratas yang aktif & disetujui
        $mobilDatas = Vehicle::where('type', 'mobil')
            ->where('status', 'active')
            ->where('mod_status', 'approve')
            // Pastikan kolom 'main_photo_url' diambil dari database
            ->select('id', 'brand', 'type', 'model', 'price_per_day', 'transmission', 'capacity', 'main_photo_url')
            ->latest()
            ->take(6)
            ->get();

        // Ambil 6 data motor teratas yang aktif & disetujui
        $motorDatas = Vehicle::where('type', 'motor')
            ->where('status', 'active')
            ->where('mod_status', 'approve')
            // Pastikan kolom 'main_photo_url' diambil dari database
            ->select('id', 'brand', 'type', 'model', 'price_per_day', 'transmission', 'capacity', 'main_photo_url')
            ->latest()
            ->take(6)
            ->get();

        return view('client.home', compact('mobilDatas', 'motorDatas'));
    }
    public function clientTampilDetail($id)
    {
        $vehicleData = Vehicle::where('id', $id)->first();
        if ($vehicleData->mod_status == "locked" || $vehicleData->status == "locked" || $vehicleData->mod_status == "reject" || $vehicleData->mod_status == "waiting" || $vehicleData->status == "inactive") {
            return redirect('/')->withErrors(["status" => ($vehicleData->brand ." ".$vehicleData->model ." Tidak dapat diakses untuk sementara")]);
        }
        $vehicleJsonLd = json_encode([
            '@context' => 'https://schema.org',
            '@type' => 'Vehicle',
            'name' => $vehicleData->brand . ' ' . $vehicleData->model,
            'description' => $vehicleData->description,
            'image' => $vehicleData->photos->map(fn($p) => asset('storage/photo/'.$vehicleData->type.'/'.$p->photo_url))->toArray(),
            'offers' => [
                '@type' => 'Offer',
                'price' => $vehicleData->price_per_day,
                'priceCurrency' => 'IDR',
                'availability' => 'https://schema.org/InStock'
            ],
            'brand' => [
                '@type' => 'Brand',
                'name' => $vehicleData->brand
            ]
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        return view('client.detail_kendaraan', compact('vehicleData', 'vehicleJsonLd'));
    }

    public function clientTampilPencarian(Request $request, $type, $city)
    {
        $vehicleGets = Vehicle::query();
        $vehicleGets->with(['photos' => function ($q) {
            $q->select('vehicle_id', 'photo_url')->limit(1);
        }])->where('status', 'active')->where('mod_status', 'approve');
        if ($type != "kendaraan") {
            $vehicleGets->where('type', $type);
        }
        if ($city != "semua") {
            $vehicleGets->where('city', strtolower($city));
        }
        // Filter Keyword (brand + model)
        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $vehicleGets->where(function ($q) use ($keyword) {
                $q->where('brand', 'like', "%{$keyword}%")
                ->orWhere('model', 'like', "%{$keyword}%");
            });
        }
        if ($request->filled('lokasi')) {
            $vehicleGets->where('city', 'like', '%' . $request->lokasi . '%');
        }

        // 2. Filter berdasarkan Tipe Transmisi (dari sidebar)  
        if ($request->filled('transmission')) {
            // $request->transmission akan berisi array ['Manual', 'Matic'] jika keduanya dicentang
            $vehicleGets->whereIn('transmission', $request->transmission);
        }
        if ($request->filled('fuel_type')) {
            $vehicleGets->where('fuel_type', $request->fuel_type);
        }
        // 3. Filter berdasarkan Rentang Harga (dari sidebar)
        if ($request->filled('min_price')) {
            $vehicleGets->where('price_per_day', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $vehicleGets->where('price_per_day', '<=', $request->max_price);
        }

        // 4. Filter berdasarkan Kapasitas Penumpang (dari sidebar)
        if ($request->filled('capacity')) {
            switch ($request->capacity) {
                case '2-4':
                    $vehicleGets->whereBetween('capacity', [2, 4]);
                    break;
                case '5-7':
                    $vehicleGets->whereBetween('capacity', [5, 7]);
                    break;
                case '>7':
                    $vehicleGets->where('capacity', '>', 7);
                    break;
            }
        }

        // Eksekusi query dengan paginasi (10 hasil per halaman)
        $vehicleDatas = $vehicleGets->select('id', 'brand', 'type', 'model', 'city', 'price_per_day', 'transmission', 'capacity', 'fuel_type', 'description', 'is_premium')
            ->orderBy('is_premium', 'DESC')->latest()->paginate(10);
        $searchCount = count($vehicleDatas);
        $old_input = $request->all();
        return view('client.hasil_pencarian', compact('vehicleDatas', 'type', 'city', 'searchCount', 'old_input'));
    }
}
