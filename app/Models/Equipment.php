<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    use HasFactory;

    protected $fillable = [
        'consultation_id',
        'equipment_name_id',
        'equipment_type_id',
        'quantity',
        'serial_number',
    ];

    public function consultations()
    {
        return $this->belongsTo(Consultation::class);
    }

    public function equipement_names()
    {
        return $this->belongsTo(Equipement_name::class, 'equipment_name_id');
    }

    public function equipement_types()
    {
        return $this->belongsTo(Equipement_type::class, 'equipment_type_id');
    }
}
