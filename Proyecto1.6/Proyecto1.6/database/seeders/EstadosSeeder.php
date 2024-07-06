<?php

namespace Database\Seeders;

use App\Models\Estado;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EstadosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Estado::insert([
            ['estadoVehi' => 'Sin arrendar'],
            ['estadoVehi' => 'Arrendado'],
            ['estadoVehi' => 'En mantención'],
            ['estadoVehi' => 'De baja']]); 
    }
}
