<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prospect extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'company',
        'email',
        'phone_number',
        'status',
        'city',
        'activity',
        'comment',
        'user_id',
    ];

    // A prospect belongs to a user (sales rep)
    public function users() {
        return $this->belongsTo(User::class);
    }

    // A prospect has one customer
    public function cutomers() {
        return $this->hasOne(Customer::class);
    }

    // A prospect has many appointments
    public function appointments() {
        return $this->hasMany(Appointment::class);
    }
}
