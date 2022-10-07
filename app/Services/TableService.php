<?php

namespace App\Services;

use App\Models\DTO\ClubGroupDTO;
use App\Models\DTO\ClubPlayerDTO;
use App\Models\DTO\GameDTO;
use App\Models\DTO\GroupDTO;
use App\Models\Group;
use App\Models\Stage;

class TableService
{
    public function getGroupTable()
    {
        $ids = collect([1, 2, 3, 4, 5, 6, 7, 8]);

        $table = $ids->map(function ($id) {
            $group = Group::find($id);

            $clubs = $group->clubs;

            $group = GroupDTO::fromModel($group);

            return [
                'id' => $group['id'],
                'letter' => $group['letter'],
                'clubs' => $clubs->map(function ($club) {
                    return ClubGroupDTO::fromModel($club);
                })
            ];
        });

        return $table;
    }

    public function getPlayoffTable(Stage $stage)
    {
        $games = $stage->games;

        return $games->map(function ($game) {
            return [
                'result' => GameDTO::fromModel($game),
                'homeClub' => ClubPlayerDTO::fromModel($game->homeClub),
                'awayClub' => ClubPlayerDTO::fromModel($game->awayClub)
            ];
        });
    }
}
