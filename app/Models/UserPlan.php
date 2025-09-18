<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPlan extends Model
{
    protected $table = 'user_plans';
    protected $fillable = [
        'user_id',
        'plan_id',
        'start_date',
        'end_date',
        'status',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class, 'plan_id');
    }
}
