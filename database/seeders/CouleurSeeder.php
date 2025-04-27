<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Couleur;

class CouleurSeeder extends Seeder
{
    public function run()
    {
        $couleurs = [
            ['nom' => 'Rouge', 'image' => 'rouge.png', 'audio' => 'rouge.mp3'],
            ['nom' => 'Bleu', 'image' => 'bleu.png', 'audio' => 'bleu.mp3'],
            ['nom' => 'Vert', 'image' => 'vert.png', 'audio' => 'vert.mp3'],
            ['nom' => 'Jaune', 'image' => 'jaune.png', 'audio' => 'jaune.mp3'],
            ['nom' => 'Noir', 'image' => 'noir.png', 'audio' => 'noir.mp3'],
            ['nom' => 'Blanc', 'image' => 'blanc.png', 'audio' => 'blanc.mp3'],
        ];

        foreach ($couleurs as $couleur) {
            Couleur::create($couleur);
        }
    }
}