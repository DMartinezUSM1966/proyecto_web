<?php

namespace Database\Seeders;

use App\Models\TipoVehiculo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoVehiculosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TipoVehiculo::insert([
            ['tipoVehiculo' => 'Super Deportivo','precio' => 200000],
            ['tipoVehiculo' => 'Deportivo','precio' => 170000],
            ['tipoVehiculo' => 'Suv','precio' => 100000],
            ['tipoVehiculo' => 'Sedán','precio' => 80000],
            ['tipoVehiculo' => 'Coupé','precio' => 80000],
            ['tipoVehiculo' => 'Camioneta','precio' => 120000],
            ['tipoVehiculo' => 'Jeep','precio' => 140000], ]); 
    }
}
