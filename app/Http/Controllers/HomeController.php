<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil 6 data mobil teratas yang aktif & disetujui
        $mobil = Vehicle::where('type', 'mobil')
            ->where('status', 'active')
            ->where('mod_status', 'approve')
            ->latest() // Urutkan dari yang terbaru
            ->take(6)   // Ambil 6 data
            ->get();

        // Ambil 6 data motor teratas yang aktif & disetujui
        $motor = Vehicle::where('type', 'motor')
            ->where('status', 'active')
            ->where('mod_status', 'approve')
            ->latest()
            ->take(6)
            ->get();

        // Kirim data mobil dan motor ke view
        return view('client.home', compact('mobil', 'motor'));
    }

    public function show($id)
    {
        // Ambil data kendaraan spesifik berdasarkan ID,
        // beserta relasi ke pemilik (user) dan foto-fotonya (photos)
        $vehicle = Vehicle::with(['user', 'photos'])
            ->where('status', 'active')
            ->where('mod_status', 'approve')
            ->findOrFail($id); // Gunakan findOrFail untuk otomatis menampilkan error 404 jika tidak ditemukan

        // Kirim data kendaraan yang ditemukan ke view
        return view('client.detail_kendaraan', compact('vehicle'));
    }
}