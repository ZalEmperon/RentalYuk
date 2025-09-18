<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'invoice_number', 'user_id', 'plan_id', 'amount', 'proof_url', 'status',
    ];

    public function user() { return $this->belongsTo(User::class); }
    public function plan() { return $this->belongsTo(Plan::class); }
}