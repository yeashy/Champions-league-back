<?php

namespace App\Services;

use App\Enums\Stages;
use App\Models\Game;
use App\Models\Stage;

class ResultsRecalculationService
{
    public function recalculate(Game $game): void
    {
        if ($game->group !== null) $this->recalculateGroupResults($game);
        else $this->recalculatePlayOffResults($game);
    }

    private function recalculateGroupResults(Game $game): void
    {
        $clubs = $game->group
            ->clubs()
            ->orderBy('points', 'DESC')
            ->orderBy('goal_difference', 'DESC')
            ->orderBy('goals_scored', 'DESC')
            ->orderBy('name', 'ASC')
            ->get();

        for ($i = 0; $i < 3; $i++) {
            if ($clubs[$i]->points === $clubs[$i + 1]->points) {
                if ($this->count2MatchWinner($clubs[$i], $clubs[$i + 1], $game->stage) === 2) {
                    $tmp = $clubs[$i + 1];
                    $clubs[$i + 1] = $clubs[$i];
                    $clubs[$i] = $tmp;
                }
            }
        }

        $place = 0;
        foreach ($clubs as $club) {
            $club->group_place = ++$place;
            if ($club->games === 6 && $club->group_place > 2) $club->stage_id = $game->stage_id;
            $club->save();
        }
    }

    private function recalculatePlayOffResults(Game $game): void
    {
        $homeClub = $game->homeClub;
        $awayClub = $game->awayClub;

        $res = $this->count2MatchWinner($homeClub, $awayClub, $game->stage);

        switch ($res) {
            case 1:
                $awayClub->stage_id = $game->stage_id;
                break;
            case 2:
                $homeClub->stage_id = $game->stage_id;
                break;
            case 3:
                $penalty = $game->penalty;
                if ($penalty->home_scored > $penalty->away_scored) $awayClub->stage_id = $game->stage_id;
                else $homeClub->stage_id = $game->stage_id;
                break;
            default:
                break;
        }

        $homeClub->save();
        $awayClub->save();
    }

    private function count2MatchWinner($club1, $club2, Stage $stage): int
    {
        if ($stage->name === 'group') {
            $games = Game::where([
                ['home_club_id', '=', $club1->id],
                ['away_club_id', '=', $club2->id],
                ['stage_id', '=', 1]
            ])
                ->orWhere([
                    ['home_club_id', '=', $club2->id],
                    ['away_club_id', '=', $club1->id],
                    ['stage_id', '=', 1]
                ])
                ->get();
        } else {
            $games = Game::where([
                ['home_club_id', '=', $club1->id],
                ['away_club_id', '=', $club2->id],
                ['stage_id', '<>', 1]
            ])
                ->orWhere([
                    ['home_club_id', '=', $club2->id],
                    ['away_club_id', '=', $club1->id],
                    ['stage_id', '<>', 1]
                ])
                ->get();

            if ($games->count() < 2) {
                return 0;
            }
        }

        $g1 = 0;
        $g2 = 0;

        foreach ($games as $game) {
            $g1 += $game->home_club_id == $club1->id ? $game->home_scored : $game->away_scored;
            $g2 += $game->home_club_id == $club2->id ? $game->home_scored : $game->away_scored;
        }

        if ($stage->name === 'group') return $g1 >= $g2 ? 1 : 2;//TODO: make Enum
        else {
            if ($g1 > $g2) return 1;
            else if ($g1 < $g2) return 2;
            else return 3;
        }
    }
}
