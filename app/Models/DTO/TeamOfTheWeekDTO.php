<?php

namespace App\Models\DTO;

use App\Models\Player;
use App\Models\TeamOfTheWeek;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeamOfTheWeekDTO implements IDTO
{

    public static function fromModel(Model $model)
    {
        $totw = [
            'type' => $model->is_good_team,
            'formation' => [
                'id' => $model->formation->id,
                'name' => $model->formation->name
            ]
        ];

        foreach ($model->formation->positions as $position) {
            $quantity = DB::table('formations_positions')
                ->where('formation_id', $model->formation->id)
                ->where('position_id', $position->id)
                ->first()
                ->quantity;

            for ($i = 0; $i < $quantity; $i++) {
                $totw['positions'][] = $position->name;
            }
        }

        foreach ($model->players as $player) {
            $totw['players'][] = [
                'id' => $player->id,
                'name' => $player->name,
                'surname' => $player->surname,
                'photo' => $player->photo,
                'rate' => $player->currentRate,
                'club' => [
                    'id' => $player->club->id,
                    'logo' => $player->club->logo
                ]
            ];
        }

        return $totw;
    }

    public static function fromRequest(Request $request)
    {
        $team = new TeamOfTheWeek();
        $team->stage_id = $request->input('stage');
        $team->formation_id = $request->input('formation');
        $team->is_good_team = $request->input('type');
        return $team;
    }
}
