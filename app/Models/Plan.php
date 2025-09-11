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

    // Relationships
    public function userPlans()
    {
        return $this->belongsTo(UserPlan::class);
    }
}
