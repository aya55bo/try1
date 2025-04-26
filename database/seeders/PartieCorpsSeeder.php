<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PartieCorps;

class PartieCorpsSeeder extends Seeder
{
    public function run(): void
    {
        PartieCorps::insert([
            ['nom' => 'Tête', 'image' => 'tete.png', 'son' => 'tete.mp3'],
            ['nom' => 'Main', 'image' => 'main.png', 'son' => 'main.mp3'],
            ['nom' => 'Pied', 'image' => 'pied.png', 'son' => 'pied.mp3'],
            ['nom' => 'Nez', 'image' => 'nez.png', 'son' => 'nez.mp3'],
            ['nom' => 'Bouche', 'image' => 'bouche.png', 'son' => 'bouche.mp3'],
            ['nom' => 'Oreille', 'image' => 'oreille.png', 'son' => 'oreille.mp3'],
            ['nom' => 'Oeil', 'image' => 'oeil.png', 'son' => 'oeil.mp3'],
            ['nom' => 'Bras', 'image' => 'bras.png', 'son' => 'bras.mp3'],
            ['nom' => 'Jambe', 'image' => 'jambe.png', 'son' => 'jambe.mp3'],
            ['nom' => 'Ventre', 'image' => 'ventre.png', 'son' => 'ventre.mp3'],
        ]);
    }
}
