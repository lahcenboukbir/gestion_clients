<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    use HasFactory;

    protected $fillable = [
        'consultation_id',
        'departure_port_id',
        'arrival_port_id',
        'departure_date_time',
        'arrival_date_time',
        'duration',
        'comment',
    ];

    public function consultations()
    {
        return $this->belongsTo(Consultation::class, 'consultation_id');
    }

    public function departure_ports()
    {
        return $this->belongsTo(Port::class, 'departure_port_id');
    }

    public function arrival_ports()
    {
        return $this->belongsTo(Port::class, 'arrival_port_id');
    }
}
