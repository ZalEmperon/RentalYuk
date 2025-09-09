<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = [
        'user_id',
        'type',
        'brand',
        'model',
        'year',
        'description',
        'price_per_day',
        'city',
        'address',
        'status',
        'mod_status',
        'is_premium',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function photos()
    {
        return $this->hasMany(VehiclePhoto::class);
    }
}
