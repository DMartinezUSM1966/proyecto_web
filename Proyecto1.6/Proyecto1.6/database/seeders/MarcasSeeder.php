<?php

namespace Database\Seeders;

use App\Models\Marca;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MarcasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Marca::insert([
            ['marca' => 'Lamborghini'],
            ['marca' => 'Audi'],
            ['marca' => 'Alfa Romeo'],
            ['marca' => 'Ferrari'],
            ['marca' => 'Mercedes Benz']]); 
    }
}
