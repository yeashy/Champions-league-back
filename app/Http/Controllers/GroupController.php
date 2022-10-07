<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\DTO\ClubGroupDTO;
use App\Models\Group;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function getClubs(): JsonResponse
    {
        $groups = Group::all();

        $groupsResults = [];
        foreach ($groups as $group) {
            $clubs = $group->clubs;

            $clubsResults = $clubs->map(function ($club) {
                return ClubGroupDTO::fromModel($club);
            });

            $groupsResults[$group->letter] = $clubsResults;
        }

        return response()->json($groupsResults);
    }

    public function addClubsToGroups(Request $request)
    {
        $groups = $request->input('groups');

        foreach ($groups as $letter => $group) {
            $groupModel = Group::where('letter', 'like', $letter)->first();

            if ($groupModel === null) {
                return response()->json([
                    "message" => "Letter {$letter} is unavailable"
                ], 404);
            }

            foreach ($group as $clubId) {
                $club = Club::find($clubId);

                if ($club === null) {
                    return response()->json([
                        "message" => "Id {$clubId} is unavailable"
                    ], 404);
                }

                $club->group_id = $groupModel->id;
                $club->save();
            }
        }

        return response()->json([
            "message" => "OK"
        ]);
    }
}
