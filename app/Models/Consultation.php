<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'user_id',
        'status',
        'notes',
        'confirmation_date',
        'consultation_date_time',
    ];

    public function customers()
    {
        return $this->belongsTo(Customer::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
