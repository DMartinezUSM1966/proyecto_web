<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Vehiculo;

class Estado extends Model
{
    protected $table = 'estado';
    public $timestamps = false;

    protected $fillable = [
        'estadoVehi',
    ];

    public function vehiculos()
    {
        return $this->hasMany(Vehiculo::class, 'estado_vehiculo');
    }
}
