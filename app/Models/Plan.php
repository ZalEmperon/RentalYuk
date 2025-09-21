<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = [
        'name',
        'price',
        'quota_ads',
        'duration_days',
        'description'
    ];

    public function userPlans()
    {
        return $this->hasMany(UserPlan::class);
    }
    public function transaction()
    {
        return $this->hasMany(Plan::class);
    }
}
