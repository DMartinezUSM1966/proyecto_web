<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoVehiculo extends Model
{
    use HasFactory;

    protected $table = 'tipo_vehiculos'; // Nombre real de la tabla en la base de datos
    public $timestamps = false;


    protected $fillable = [
        'tipoVehiculo',
        'precio',
    ];

    public function vehiculos()
    {
        return $this->hasMany(Vehiculo::class, 'tipo_vehiculo_id');
    }

    
}
