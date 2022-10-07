<?php

namespace App\Services;

use App\Jobs\AddGameJob;
use App\Models\Game;
use App\Models\Penalty;
use App\Models\Player;
use App\Models\Video;
use Illuminate\Support\Facades\DB;

class GameService
{
    public function countAllResults(array $homePlayers, array $awayPlayers, array|null $videos, array|null $penalties, Game $game): Game
    {
        $this->countPenalties($game->id, $penalties);
        $game = $this->countGoals($homePlayers, $awayPlayers, $game);
        $game = $this->makeResults($game);
        $this->makeClubResults($game);
        $this->makePlayerResults($homePlayers, $awayPlayers);
        $this->addPlayerResultsToTable($homePlayers, $awayPlayers, $game->id);

        if ($videos !== null) {
            $this->addVideos($videos, $game->id);
        }

        return $game;
    }

    public function makeGameWith(int $homeId, int $awayId, int $stageId, int $groupId = null)
    {
        AddGameJob::dispatch($homeId, $awayId, $stageId, $groupId)->onQueue('high');
    }

    private function countGoals(array $homePlayers, array $awayPlayers, Game $game): Game
    {
        foreach ($homePlayers as $homePlayer) {
            $game->home_scored += $homePlayer['goals'];
            $game->away_scored += $homePlayer['own_goals'];
        }

        foreach ($awayPlayers as $awayPlayer) {
            $game->away_scored += $awayPlayer['goals'];
            $game->home_scored += $awayPlayer['own_goals'];
        }

        return $game;
    }

    private function countPenalties(Game $gameId, array $penalties): void
    {
        $penalty = new Penalty();
        $penalty->game_id = $gameId;
        $penalty->home_scored = $penalties[0];
        $penalty->away_scored = $penalties[1];

        $penalty->save();
    }

    private function makeResults(Game $game): Game
    {
        if ($game->home_scored > $game->away_scored) {
            $game->winner_club_id = $game->home_club_id;
            $game->loser_club_id = $game->away_club_id;
        } else if ($game->home_scored < $game->away_scored) {
            $game->winner_club_id = $game->away_club_id;
            $game->loser_club_id = $game->home_club_id;
        }

        $game->has_played = true;

        return $game;
    }

    private function makeClubResults(Game $game): void
    {
        $homeClub = $game->homeClub;
        $awayClub = $game->awayClub;
        $winner = $game->winner;
        $loser = $game->loser;

        ++$homeClub->games;
        $homeClub->goals_scored += $game->home_scored;
        $homeClub->goals_conceded += $game->away_scored;
        $homeClub->goal_difference = $homeClub->goals_scored - $homeClub->goals_conceded;

        ++$awayClub->games;
        $awayClub->goals_scored += $game->away_scored;
        $awayClub->goals_conceded += $game->home_scored;
        $awayClub->goal_difference = $awayClub->goals_scored - $awayClub->goals_conceded;

        if ($game->winner !== null) {
            ++$winner->wins;
            ++$loser->losses;
            $winner->points += 3;
        } else {
            ++$homeClub->draws;
            ++$awayClub->draws;
            ++$homeClub->points;
            ++$awayClub->points;
        }

        $homeClub->save();
        $awayClub->save();
        $winner->save();
        $loser->save();
    }

    private function makePlayerResults(array $homePlayers, array $awayPlayers): void
    {
        foreach ($homePlayers as $homePlayer) {
            $player = Player::find($homePlayer['id']);

            $player = $this->countPlayer($player, $homePlayer);
            $player->save();
        }

        foreach ($awayPlayers as $awayPlayer) {
            $player = Player::find($awayPlayer['id']);

            $player = $this->countPlayer($player, $awayPlayer);
            $player->save();
        }
    }

    private function countPlayer(Player $player, array $homePlayer): Player
    {
        ++$player->games;
        $player->goals += $homePlayer['goals'];
        $player->assists += $homePlayer['assists'];
        $player->own_goals += $homePlayer['own_goals'];
        $player->yellow_cards += $homePlayer['yellow_cards'];
        $player->red_cards += $homePlayer['red_cards'];
        $player->current_rate += $homePlayer['rate'];
        $player->avg_rate = ($player->avg_rate * ($player->games - 1) + $player->current_rate) / $player->games;

        return $player;
    }

    private function addPlayerResultsToTable(array $homePlayers, array $awayPlayers, int $gameId): void
    {
        $gamesPlayers = [];

        foreach ($homePlayers as $player) {
            $gamePlayer = $this->createGamePlayerEntity($gameId, $player);
            $gamesPlayers[] = $gamePlayer;
        }

        foreach ($awayPlayers as $player) {
            $gamePlayer = $this->createGamePlayerEntity($gameId, $player);
            $gamesPlayers[] = $gamePlayer;
        }

        DB::table('games_players')->insert($gamesPlayers);
    }

    private function createGamePlayerEntity(int $gameId, array $player): array
    {
        return [
            "game_id" => $gameId,
            "player_id" => $player['id'],
            "goals" => $player['goals'],
            "assists" => $player['assists'],
            "own_goals" => $player['own_goals'],
            "red_cards" => $player['red_cards'],
            "yellow_cards" => $player['yellow_cards'],
            "rate" => $player['rate']
        ];
    }

    private function addVideos(array $videos, int $gameId): void
    {
        foreach ($videos as $videoFromRequest) {
            $video = new Video();

            $video->game_id = $gameId;
            $video->path = $videoFromRequest->path;

            $video->save();
        }
    }

    private function dropAllCurrentRates()
    {
        Player::query()->update(["current_rate" => null]);
    }
}
