<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    use HasFactory;
    protected $table = 'marcas';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'marca'
    ];

    public function vehiculos()
    {
        return $this->hasMany(Vehiculo::class, 'marca');
    }


}
