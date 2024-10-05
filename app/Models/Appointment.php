<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'prospect_id',
        'users_id',
        'appointment_date',
        'notes',
        'outcome',
    ];

    // An appointment belongs to a user (sales rep)
    public function prospects()
    {
        return $this->belongsTo(Prospect::class);
    }

    // An appointment belongs to a prospect
    public function prospect()
    {
        return $this->belongsTo(Prospect::class);
    }
}
