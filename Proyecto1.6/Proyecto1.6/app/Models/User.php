<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Perfil;
use App\Models\Arriendo;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    public $timestamps = false;

    


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'email',
        'password',
        'nombre',
        'rut',
        'cargo'       
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        // 'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            // 'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    public function perfil(){
        return $this->belongsTo(Perfil::class, 'cargo');           //Este metodo, establece la relacion entre usuario y perfil, 
    }  

    public function arriendos()
    {
        return $this->hasMany(Arriendo::class, 'usuario_id');
    }
    
}
