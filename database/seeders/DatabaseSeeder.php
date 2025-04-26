<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Appelle ton AlphabetSeeder ici
        $this->call([
            AlphabetSeeder::class,
            PartieCorpsSeeder::class,
        ]);
    }
}
