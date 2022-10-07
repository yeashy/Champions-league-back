<?php

namespace Database\Seeders;

use App\Models\Formation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FormationsSeeder extends Seeder
{
    private array $formations = [
        '3-1-4-2',
        '3-4-1-2',
        '3-4-2-1',
        '3-4-3',
        '3-5-2',
        '4-1-2-1-2',
        '4-1-2-1-2 (2)',
        '4-1-3-2',
        '4-1-4-1',
        '4-2-3-1',
        '4-2-3-1 (2)',
        '4-2-2-2',
        '4-2-4',
        '4-3-1-2',
        '4-3-2-1',
        '4-3-3',
        '4-3-3 (2)',
        '4-3-3 (3)',
        '4-3-3 (4)',
        '4-3-3 (5)',
        '4-4-1-1',
        '4-4-1-1 (2)',
        '4-4-2',
        '4-4-2 (2)',
        '4-5-1',
        '4-5-1 (2)',
        '5-2-1-2',
        '5-2-2-1',
        '5-3-2',
        '5-4-1'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->formations as $formation) {
            $this->createFormation($formation);
        }
    }

    private function createFormation(string $name): void
    {
        $formation = new Formation();
        $formation->name = $name;
        $formation->save();
    }
}
