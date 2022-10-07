<?php

namespace App\Models\DTO;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class StageDTO implements IDTO
{

    public static function fromModel(Model $model)
    {
        return [
            'id' => $model->id,
            'name' => $model->name,
            'num_of_clubs' => $model->num_of_clubs,
            'games' => $model->games->map(function ($game) {
                return [
                    'game' => GameDTO::fromModel($game),
                    'home' => ClubPlayerDTO::fromModel($game->homeClub),
                    'away' => ClubPlayerDTO::fromModel($game->awayClub),
                    'group' => $game->group->letter ?? null
                ];
            })
        ];
    }

    public static function fromRequest(Request $request)
    {
        // TODO: Implement fromRequest() method.
    }
}
