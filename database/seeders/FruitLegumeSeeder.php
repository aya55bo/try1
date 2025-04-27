<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\FruitLegume;
class FruitLegumeSeeder extends Seeder
{
    public function run()
    {
        FruitLegume::create([
            'name' => 'Pomme',
            'type' => 'fruit',
            'image_path' => 'images/pomme.png',
        ]);

        FruitLegume::create([
            'name' => 'Banane',
            'type' => 'fruit',
            'image_path' => 'images/banane.png',
        ]);

        FruitLegume::create([
            'name' => 'Carotte',
            'type' => 'légume',
            'image_path' => 'images/carotte.png',
        ]);

        FruitLegume::create([
            'name' => 'Brocoli',
            'type' => 'légume',
            'image_path' => 'images/brocoli.png',
        ]);
    }
}