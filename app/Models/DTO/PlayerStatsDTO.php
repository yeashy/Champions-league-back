<?php

namespace App\Models\DTO;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class PlayerStatsDTO implements IDTO
{
    public static function fromModel(Model $player)
    {
        return [
            "id" => $player->id,
            "name" => $player->name,
            "surname" => $player->surname,
            "photo" => $player->photo,
            "games" => $player->games,
            "avg_rate" => $player->avg_rate,
            "goals" => $player->goals,
            "assists" => $player->assists,
            "own_goals" => $player->own_goals,
            "yellow_cards" => $player->yellow_cards,
            "red_cards" => $player->red_cards,
            "clean_sheets" => $player->clean_sheets,
            "position" => $player->position->name
        ];
    }

    public static function fromRequest(Request $request)
    {
    }
}
