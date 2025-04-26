<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChiffresSeeder extends Seeder
{
    public function run()
    {
        $chiffres = [
            [
                'valeur' => 0,
                'nom' => 'Zéro',
                'description' => 'Le chiffre zéro',
                'image_path' => 'images/chiffres/0.png',
                'son_path' => 'sons/chiffres/0.mp3',
            ],
            [
                'valeur' => 1,
                'nom' => 'Un',
                'description' => 'Le chiffre un',
                'image_path' => 'images/chiffres/1.png',
                'son_path' => 'sons/chiffres/1.mp3',
            ],
            // Ajoutez les autres chiffres ici
        ];

        foreach ($chiffres as $chiffre) {
            DB::table('chiffres')->insert($chiffre);
        }
    }
}