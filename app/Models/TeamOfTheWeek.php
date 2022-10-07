<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $stage_id
 * @property int $formation_id
 * @property mixed $is_good_team
 * @property int $id
 */
class TeamOfTheWeek extends Model
{
    use HasFactory;

    public function stage()
    {
        return $this->belongsTo(Stage::class);
    }

    public function players()
    {
        return $this->belongsToMany(Player::class, 'player_team_of_the_week', 'team_of_the_week_id', 'player_id');
    }

    public function formation()
    {
        return $this->belongsTo(Formation::class);
    }
}
