<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipement_type extends Model
{
    use HasFactory;

    protected $fillable = ['type_name'];

    public function equipements()
    {
        return $this->hasMany(Equipment::class, 'equipment_type_id');
    }
}
