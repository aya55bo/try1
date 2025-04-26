<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Chiffre;

class ChiffreSeeder extends Seeder
{
    public function run()
    {
        for ($i = 0; $i <= 9; $i++) {
            $nom = match($i) {
                0 => 'zéro',
                1 => 'un',
                2 => 'deux',
                3 => 'trois',
                4 => 'quatre',
                5 => 'cinq',
                6 => 'six',
                7 => 'sept',
                8 => 'huit',
                9 => 'neuf',
                10 => 'dix',
                11 => 'onze',
                12 => 'douze',
                13=> 'treize',
                14=> 'quatorze',
                15=> 'quize',
                16=> 'seize',
                17=> 'dix-sept',
                18=> 'dix-huit',
                19=> 'dix-neuf',
                20=> 'vingt',
                default => ''
            };
            
            Chiffre::create([
                'valeur' => $i,
                'nom' => $nom,
                'description' => "Le chiffre $nom",
                'image_path' => "images/chiffres/$i.png",
                'son_path' => "sons/chiffres/$i.mp3"
            ]);
        }
    }
}