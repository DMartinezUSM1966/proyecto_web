<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Perfil extends Model
{
    use HasFactory;
    protected $table = 'perfiles';
    protected $primaryKey = 'id';
    protected $fillable = ['cargo'];
    public $timestamps = false;

    public function usuarios()
    {
        return $this->hasMany(User::class);
        
    }
}
