<?php

namespace Database\Seeders;

use App\Enums\Stages;
use App\Models\Stage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StageSeeder extends Seeder
{
    private array $stages = [
        [
            'name' => Stages::GroupStage1,
            'num_of_clubs' => 32
        ],
        [
            'name' => Stages::GroupStage2,
            'num_of_clubs' => 32
        ],
        [
            'name' => Stages::GroupStage3,
            'num_of_clubs' => 32
        ],
        [
            'name' => Stages::GroupStage4,
            'num_of_clubs' => 32
        ],
        [
            'name' => Stages::GroupStage5,
            'num_of_clubs' => 32
        ],
        [
            'name' => Stages::GroupStage6,
            'num_of_clubs' => 32
        ],
        [
            'name' => Stages::FirstRound,
            'num_of_clubs' => 16
        ],
        [
            'name' => Stages::QuaterFinal,
            'num_of_clubs' => 8
        ],
        [
            'name' => Stages::SemiFinal,
            'num_of_clubs' => 4
        ],
        [
            'name' => Stages::Final,
            'num_of_clubs' => 2
        ],
        [
            'name' => Stages::Winner,
            'num_of_clubs' => 1
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->stages as $stage) {
            $newStage = new Stage();
            $newStage->name = $stage['name'];
            $newStage->num_of_clubs = $stage['num_of_clubs'];
            $newStage->save();

            if ($newStage->id === 1) {
                $newStage->is_active = true;
                $newStage->save();
            }
        }
    }
}
