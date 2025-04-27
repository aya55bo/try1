
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transport;

class TransportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Transport::create([
            'nom' => 'Avion',
            'image' => 'avion.png',
            'son' => 'avion.mp3',
        ]);

        Transport::create([
            'nom' => 'Train',
            'image' => 'train.png',
            'son' => 'train.mp3',
        ]);

        Transport::create([
            'nom' => 'Bus',
            'image' => 'bus.png',
            'son' => 'bus.mp3',
        ]);

        Transport::create([
            'nom' => 'Voiture',
            'image' => 'voiture.png',
            'son' => 'voiture.mp3',
        ]);

        Transport::create([
            'nom' => 'Bicyclette',
            'image' => 'bicyclette.png',
            'son' => 'bicyclette.mp3',
        ]);
    }
}
