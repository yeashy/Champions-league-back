<?php

namespace App\Http\Controllers;

use App\Models\DTO\PlayerStatsDTO;
use App\Models\Position;
use Illuminate\Http\JsonResponse;

class PositionController extends Controller
{
    public function getPlayers($id): JsonResponse
    {
        $position = Position::find($id);

        if ($position === null) {
            return response()->json([
                "message" => "Id is unavailable"
            ], 404);
        }

        $players = $position->players;

        $playersResult = $players->map(function ($player) {
            return PlayerStatsDTO::fromModel($player);
        });

        return response()->json($playersResult);
    }
}
