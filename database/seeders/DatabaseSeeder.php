<?php

namespace Database\Seeders;

use App\Models\Plan;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $publicStorageLink = public_path('storage');
        if (!is_link($publicStorageLink)) {
            Artisan::call('storage:link');
        }
        if (!Storage::disk('public')->exists('photo')) {
            Storage::disk('public')->makeDirectory('photo');
        }
        if (!Storage::disk('public')->exists('photo/mobil')) {
            Storage::disk('public')->makeDirectory('photo/mobil');
        }
        if (!Storage::disk('public')->exists('photo/motor')) {
            Storage::disk('public')->makeDirectory('photo/motor');
        }
        if (!Storage::disk('public')->exists('photo/other')) {
            Storage::disk('public')->makeDirectory('photo/other');
        }
        Plan::insert(
            [
                [
                    'name' => 'Gratis',
                    'price' => null,
                    'quota_ads' => 1,
                    'duration_days' => null,
                    'description' => 'Cocok untuk iklan sederhana dengan keterbatasan fitur.',
                ],
                [
                    'name' => 'Premium',
                    'price' => 50000,
                    'quota_ads' => 5,
                    'duration_days' => 30,
                    'description' => 'Ideal untuk promosi lebih dengan beberapa fitur.',
                ],
                [
                    'name' => 'Premium+',
                    'price' => 100000,
                    'quota_ads' => 15,
                    'duration_days' => 30,
                    'description' => 'Ideal untuk promosi serius dengan fitur lengkap.',
                ]
            ]
        );
    }
}
