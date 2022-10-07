<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $name
 * @property string $surname
 * @property string $photo
 * @property int $club_id
 * @property int $position_id
 * @property int $id
 * @property int $goals
 * @property int $assists
 * @property int $own_goals
 * @property int $games
 * @property float $avg_rate
 * @property float $current_rate
 * @property Club $club
 * @property int $yellow_cards
 * @property int $red_cards
 */
class Player extends Model
{
    use HasFactory;

    public function club()
    {
        return $this->belongsTo(Club::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function teamsOfTheWeeks()
    {
        return $this->belongsToMany(TeamOfTheWeek::class, 'player_team_of_the_week', 'player_id', 'team_of_the_week_id');
    }

}
