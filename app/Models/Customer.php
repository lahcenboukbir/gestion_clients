<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'prospect_id',
    ];

    // A customer belongs to a prospect
    public function prospects() {
        return $this->belongsTo(Prospect::class);
    }

    // A customer belongs to a user (sales rep)
    public function users() {
        return $this->belongsTo(User::class);
    }
}
