<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            InitialSeeder::class,
            PositionsSeeder::class,
            FormationsSeeder::class,
            FormationsPositionsSeeder::class,
            StageSeeder::class,
            PotSeeder::class,
            GroupSeeder::class,
            ClubSeeder::class
        ]);
    }
}
