<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    public $timestamps = false;

    

    protected $fillable = [
        'id',
        'rut',
        'nombre',
        'apellido',
        'telefono',
    ];


    public function arriendos()
    {
        return $this->hasMany(Arriendo::class, 'cliente_id');
    }
}
