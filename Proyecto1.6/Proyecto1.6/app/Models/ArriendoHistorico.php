<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArriendoHistorico extends Model
{
    use HasFactory;

    protected $fillable = [
        'cliente_id',  
        'vehiculo_id',
        'fecha_arriendo', 
        'fecha_arriendo', 
        'estado_arriendo',
        'total', 
        'observaciones',
    ];
    
    public $timestamps = false;

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class, 'vehiculo_id');
    }
}
