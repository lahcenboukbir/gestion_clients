<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Port extends Model
{
    use HasFactory;

    protected $fillable = ['port_name'];

    public function departure_ports()
    {
        return $this->hasMany(Shipment::class, 'departure_port');
    }

    public function arrival_ports()
    {
        return $this->hasMany(Shipment::class, 'arrival_port');
    }
}
