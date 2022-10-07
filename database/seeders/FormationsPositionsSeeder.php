<?php

namespace Database\Seeders;

use App\Models\Formation;
use App\Models\Position;
use App\Enums\Positions as P;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class FormationsPositionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->addAll();
    }

    private function addPositionsToFormation(string $formation, array $positions): void
    {
        foreach ($positions as $position => $quantity) {
            $posId = Position::select('id')->where('name', 'like', $position)->first()->id;
            $formId = Formation::select('id')->where('name', 'like', $formation)->first()->id;
            DB::table('formations_positions')->insert([
                "position_id" => $posId,
                "formation_id" => $formId,
                "quantity" => $quantity
            ]);
        }
    }

    private function addAll()
    {
        $ALL = [
            "3-1-4-2" => [
                P::GK => 1,
                P::CB => 3,
                P::CDM => 1,
                P::CM => 2,
                P::LM => 1,
                P::RM => 1,
                P::ST => 2
            ],
            "3-4-1-2" => [
                P::GK => 1,
                P::CB => 3,
                P::CM => 2,
                P::LM => 1,
                P::RM => 1,
                P::CAM => 1,
                P::ST => 2
            ],
            "3-4-2-1" => [
                P::GK => 1,
                P::CB => 3,
                P::CM => 2,
                P::LM => 1,
                P::RM => 1,
                P::LF => 1,
                P::RF => 1,
                P::ST => 1
            ],
            "3-4-3" => [
                P::GK => 1,
                P::CB => 3,
                P::CM => 2,
                P::LM => 1,
                P::RM => 1,
                P::LW => 1,
                P::RW => 1,
                P::ST => 1
            ],
            "3-5-2" => [
                P::GK => 1,
                P::CB => 3,
                P::CDM => 2,
                P::LM => 1,
                P::RM => 1,
                P::CAM => 1,
                P::ST => 2
            ],
            "4-1-2-1-2" => [
                P::GK => 1,
                P::CB => 2,
                P::LB => 1,
                P::RB => 1,
                P::CDM => 1,
                P::LM => 1,
                P::RM => 1,
                P::CAM => 1,
                P::ST => 2
            ],
            "4-1-2-1-2 (2)" => [
                P::GK => 1,
                P::CB => 2,
                P::LB => 1,
                P::RB => 1,
                P::CDM => 1,
                P::CM => 2,
                P::CAM => 1,
                P::ST => 2
            ],
            "4-1-3-2" => [
                P::GK => 1,
                P::CB => 2,
                P::LB => 1,
                P::RB => 1,
                P::CDM => 1,
                P::CM => 1,
                P::LM => 1,
                P::RM => 1,
                P::ST => 2
            ],
            "4-1-4-1" => [
                P::GK => 1,
                P::CB => 2,
                P::LB => 1,
                P::RB => 1,
                P::CDM => 1,
                P::CM => 2,
                P::LM => 1,
                P::RM => 1,
                P::ST => 1
            ],
            "4-2-3-1" => [
                P::GK => 1,
                P::CB => 2,
                P::LB => 1,
                P::RB => 1,
                P::CDM => 2,
                P::CAM => 3,
                P::ST => 1
            ],
            "4-2-3-1 (2)" => [
                P::GK => 1,
                P::CB => 2,
                P::LB => 1,
                P::RB => 1,
                P::CDM => 2,
                P::LM => 1,
                P::RM => 1,
                P::CAM => 1,
                P::ST => 1
            ],
            "4-2-2-2" => [
                P::GK => 1,
                P::CB => 2,
                P::LB => 1,
                P::RB => 1,
                P::CDM => 2,
                P::CAM => 2,
                P::ST => 2
            ],
            "4-2-4" => [
                P::GK => 1,
                P::CB => 2,
                P::LB => 1,
                P::RB => 1,
                P::CM => 2,
                P::LW => 1,
                P::RW => 1,
                P::ST => 2
            ],
            "4-3-1-2" => [
                P::GK => 1,
                P::CB => 2,
                P::LB => 1,
                P::RB => 1,
                P::CM => 3,
                P::CAM => 1,
                P::ST => 2
            ],
            "4-3-2-1" => [
                P::GK => 1,
                P::CB => 2,
                P::LB => 1,
                P::RB => 1,
                P::CM => 3,
                P::LF => 1,
                P::RF => 1,
                P::ST => 1
            ],
            "4-3-3" => [
                P::GK => 1,
                P::CB => 2,
                P::LB => 1,
                P::RB => 1,
                P::CM => 3,
                P::LW => 1,
                P::RW => 1,
                P::ST => 1
            ],
            "4-3-3 (2)" => [
                P::GK => 1,
                P::CB => 2,
                P::LB => 1,
                P::RB => 1,
                P::CDM => 1,
                P::CM => 2,
                P::LW => 1,
                P::RW => 1,
                P::ST => 1
            ],
            "4-3-3 (3)" => [
                P::GK => 1,
                P::CB => 2,
                P::LB => 1,
                P::RB => 1,
                P::CDM => 2,
                P::CM => 1,
                P::LW => 1,
                P::RW => 1,
                P::ST => 1
            ],
            "4-3-3 (4)" => [
                P::GK => 1,
                P::CB => 2,
                P::LB => 1,
                P::RB => 1,
                P::CM => 2,
                P::CAM => 1,
                P::LW => 1,
                P::RW => 1,
                P::ST => 1
            ],
            "4-3-3 (5)" => [
                P::GK => 1,
                P::CB => 2,
                P::LB => 1,
                P::RB => 1,
                P::CDM => 1,
                P::CM => 2,
                P::LW => 1,
                P::RW => 1,
                P::CF => 1
            ],
            "4-4-1-1" => [
                P::GK => 1,
                P::CB => 2,
                P::LB => 1,
                P::RB => 1,
                P::CM => 2,
                P::LM => 1,
                P::RM => 1,
                P::CF => 1,
                P::ST => 1
            ],
            "4-4-1-1 (2)" => [
                P::GK => 1,
                P::CB => 2,
                P::LB => 1,
                P::RB => 1,
                P::CM => 2,
                P::LM => 1,
                P::RM => 1,
                P::CAM => 1,
                P::ST => 1
            ],
            "4-4-2" => [
                P::GK => 1,
                P::CB => 2,
                P::LB => 1,
                P::RB => 1,
                P::CM => 2,
                P::LM => 1,
                P::RM => 1,
                P::ST => 2
            ],
            "4-4-2 (2)" => [
                P::GK => 1,
                P::CB => 2,
                P::LB => 1,
                P::RB => 1,
                P::CDM => 2,
                P::LM => 1,
                P::RM => 1,
                P::ST => 2
            ],
            "4-5-1" => [
                P::GK => 1,
                P::CB => 2,
                P::LB => 1,
                P::RB => 1,
                P::CM => 1,
                P::LM => 1,
                P::RM => 1,
                P::CAM => 2,
                P::ST => 1
            ],
            "4-5-1 (2)" => [
                P::GK => 1,
                P::CB => 2,
                P::LB => 1,
                P::RB => 1,
                P::CM => 3,
                P::LM => 1,
                P::RM => 1,
                P::ST => 1
            ],
            "5-2-1-2" => [
                P::GK => 1,
                P::CB => 3,
                P::LWB => 1,
                P::RWB => 1,
                P::CM => 2,
                P::CAM => 1,
                P::ST => 2
            ],
            "5-2-2-1" => [
                P::GK => 1,
                P::CB => 3,
                P::LWB => 1,
                P::RWB => 1,
                P::CM => 2,
                P::LW => 1,
                P::RW => 1,
                P::ST => 1
            ],
            "5-3-2" => [
                P::GK => 1,
                P::CB => 3,
                P::LWB => 1,
                P::RWB => 1,
                P::CM => 3,
                P::ST => 2
            ],
            "5-4-1" => [
                P::GK => 1,
                P::CB => 3,
                P::LWB => 1,
                P::RWB => 1,
                P::CM => 2,
                P::LM => 1,
                P::RM => 1,
                P::ST => 1
            ]
        ];

        foreach ($ALL as $formation => $positions) {
            $this->addPositionsToFormation($formation, $positions);
        }
    }
}
