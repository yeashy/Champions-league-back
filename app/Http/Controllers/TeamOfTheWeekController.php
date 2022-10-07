<?php

namespace App\Http\Controllers;

use App\Jobs\AddPlayerTotwJob;
use App\Models\DTO\PlayerTOTWDTO;
use App\Models\DTO\TeamOfTheWeekDTO;
use App\Models\Position;
use App\Models\TeamOfTheWeek;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TeamOfTheWeekController extends Controller
{
    public function create(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'stage' => 'int|required|exists:stages,id',
            'formation' => 'int|required|exists:formations,id',
            'players' => 'array|required',
            'type' => 'bool|required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                "message" => $validator->errors()->all()
            ], 400);
        }

        $team = TeamOfTheWeekDTO::fromRequest($request);
        $team->save();

        try {
            $players = PlayerTOTWDTO::fromRequest($request);

            foreach ($players as $player) {
                AddPlayerTotwJob::dispatch($player, $team->id)->onQueue('high');
            }
        } catch (\Throwable $e) {
            return response()->json([
                "message" => $e->getMessage()
            ], 400);
        }

        return response()->json([
            "message" => "OK"
        ]);
    }

    public function read($id)
    {
        $totw = TeamOfTheWeek::find($id);

        if ($totw === null) {
            return response()->json([
                "message" => "Id is unavailable"
            ])->setStatusCode(404);
        }

        try {
            $totw = TeamOfTheWeekDTO::fromModel(TeamOfTheWeek::find($id));
        } catch (\Throwable $e) {
            return response()->json([
                "message" => "Oops... Something went wrong",
                "error" => $e->getMessage()
            ], 500);
        }

        return response()->json($totw);
    }
}
