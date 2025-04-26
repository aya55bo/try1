<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Alphabet;

class AlphabetSeeder extends Seeder
{
    public function run(): void
    {
        foreach (range('A', 'Z') as $lettre) {
            Alphabet::create([
                'lettre' => $lettre,
                'image' => $lettre . '.png', // Image doit être dans public/images/A.png, etc.
                'son' => $lettre . '.mp3',   // Son dans public/sons/A.mp3, etc.
            ]);
        }
    }
}
