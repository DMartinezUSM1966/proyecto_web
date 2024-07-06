<?php

namespace Database\Seeders;

use App\Models\Perfil;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $perfilAdmin = Perfil::where('cargo', 'Administrador')->first();
        $perfilEjecutivo= Perfil::where('cargo', 'Ejecutivo')->first();


        User::insert([
            [
                'email' => 'diego@gmail.com',
                'password' => Hash::make('admin'),
                'nombre' => 'Diego Martinez',
                'rut' => '21257768-5',
                'cargo' => $perfilAdmin->id,
                
            ],
            [
                'email' => 'jeremy@gmail.com',
                'password' => Hash::make('admin'),
                'nombre' => 'Jeremy Arriagada',
                'rut' => '21349888-6',
                'cargo' => $perfilEjecutivo->id,
            ],
        ]);
    }
}
