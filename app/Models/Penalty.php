<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $home_scored
 * @property int $away_scored
 * @property int $game_id
 */
class Penalty extends Model
{
    use HasFactory;

    public function game()
    {
        return $this->belongsTo(Game::class);
    }
}
