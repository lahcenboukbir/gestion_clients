<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipement_name extends Model
{
    use HasFactory;

    protected $fillable = ['equipment_name'];

    public function equipements()
    {
        return $this->hasMany(Equipment::class, 'equipment_id');
    }
}
