<?php

namespace App\Models\DTO;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class PlayerTOTWDTO implements IDTO
{

    public static function fromModel(Model $model)
    {

    }

    public static function fromRequest(Request $request)
    {
        $players = collect($request->input('players'));

        return $players->map(function ($player) {
            return [
                'player_id' => $player['id'],
                'position_id' => $player['position']
            ];
        });
    }
}
