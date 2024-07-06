<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TipoVehiculo;
use App\Models\Estado;
use App\Models\Arriendo;

class Vehiculo extends Model
{
    protected $table = 'vehiculos';
    public $timestamps = false;


    protected $fillable = [
        'id',
        'año',
        'marcaVehiculo',
        'modelo',
        'patente',
        'tipo_vehiculo_id',
        'estado_vehiculo',
        'url_imagen',
    ];

    public function tipoVehiculo()
    {
        return $this->belongsTo(TipoVehiculo::class, 'tipo_vehiculo_id');
    }

    public function estado()
    {
        return $this->belongsTo(Estado::class, 'estado_vehiculo');
    }

    public function arriendos()
    {
        return $this->hasMany(Arriendo::class, 'vehiculo_id');
    }

    public function marca()
    {
        return $this->belongsTo(Marca::class, 'marcaVehiculo');
    }
}