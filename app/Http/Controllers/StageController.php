<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\DTO\ClubPlayerDTO;
use App\Models\DTO\GameDTO;
use App\Models\DTO\GameStageDTO;
use App\Models\DTO\StageDTO;
use App\Models\Game;
use App\Models\Group;
use App\Models\Stage;
use App\Services\GameService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StageController extends Controller
{
    public function getActiveStage(): JsonResponse
    {
        $stage = Stage::where('is_active', true)->first();
        $stage = StageDTO::fromModel($stage);

        return response()->json($stage);
    }

    public function getNextGame()
    {
        $stage = Stage::where('is_active', true)->first();
        $games = $stage->games()->where('has_played', false)->get();

        if ($games->isEmpty()) {
            $newStage = Stage::find($stage->id + 1);
            $stage->is_active = false;
            $newStage->is_active = true;
            $stage->save();
            $newStage->save();

            return response()->json([
                "message" => "All games has played for the current stage",
                "stage" => GameStageDTO::fromModel($stage),
            ]);
        }

        $nextGame = $games->random();

        $result = [
            'result' => GameDTO::fromModel($nextGame),
            'homeClub' => ClubPlayerDTO::fromModel($nextGame->homeClub),
            'awayClub' => ClubPlayerDTO::fromModel($nextGame->awayClub),
            'stage' => GameStageDTO::fromModel($stage)
        ];

        return response()->json($result);
    }

    public function makePlayOffShuffle(Request $request, GameService $service): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'data' => 'required|array'
        ]);

        if ($validator->fails()) {
            return response()->json([
                "message" => $validator->errors()->all()
            ], 400);
        }

        $pairs = collect($request->input('data'));

        switch ($pairs->count()) {
            case 8:
                $stage = 7;
                break;
            case 4:
                $stage = 8;
                break;
            case 2:
                $stage = 9;
                break;
            case 1:
                $stage = 10;
                break;
            default:
                return response()->json([
                    "message" => "Pairs count invalid"
                ], 400);
        }

        if ($stage !== 10) {
            foreach ($pairs as $pair) {
                $service->makeGameWith($pair['id1'], $pair['id2'], $stage);
            }

            foreach ($pairs as $pair) {
                $service->makeGameWith($pair['id2'], $pair['id1'], $stage);
            }
        } else {
            $pair = $pairs[0];
            $service->makeGameWith($pair['id1'], $pair['id2'], $stage);
        }

        return response()->json([
            'message' => 'OK'
        ]);
    }

    public function makeGroupShuffle(Request $request, GameService $service): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'data' => 'required|array'
        ]);

        if ($validator->fails()) {
            return response()->json([
                "message" => $validator->errors()->all()
            ], 400);
        }

        $clubs = $request->input('data');

        foreach ($clubs as $club) {
            $shuffleClub = Club::find($club['id']);
            $shuffleClub->group_id = $club['group'];
            $shuffleClub->save();
        }

        $this->makeGroupSchedule($service);

        return response()->json([
            'message' => 'OK'
        ]);
    }

    private function makeGroupSchedule(GameService $service)
    {
        $groups = Group::all();
        Game::truncate();

        foreach ($groups as $group) {
            $clubs = $group->clubs;

            $service->makeGameWith($clubs[0]->id, $clubs[3]->id, 1, $group->id);
            $service->makeGameWith($clubs[1]->id, $clubs[2]->id, 1, $group->id);

            $service->makeGameWith($clubs[0]->id, $clubs[2]->id, 2, $group->id);
            $service->makeGameWith($clubs[1]->id, $clubs[3]->id, 2, $group->id);

            $service->makeGameWith($clubs[0]->id, $clubs[1]->id, 3, $group->id);
            $service->makeGameWith($clubs[2]->id, $clubs[3]->id, 3, $group->id);

            $service->makeGameWith($clubs[1]->id, $clubs[0]->id, 4, $group->id);
            $service->makeGameWith($clubs[3]->id, $clubs[2]->id, 4, $group->id);

            $service->makeGameWith($clubs[2]->id, $clubs[0]->id, 5, $group->id);
            $service->makeGameWith($clubs[3]->id, $clubs[1]->id, 5, $group->id);

            $service->makeGameWith($clubs[3]->id, $clubs[0]->id, 6, $group->id);
            $service->makeGameWith($clubs[2]->id, $clubs[1]->id, 6, $group->id);
        }
    }
}
