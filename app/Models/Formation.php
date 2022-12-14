<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $name
 */
class Formation extends Model
{
    use HasFactory;

    public function positions()
    {
        return $this->belongsToMany(Position::class, 'formations_positions', 'formation_id', 'position_id');
    }

    public function totws()
    {
        return $this->hasMany(TeamOfTheWeek::class);
    }
}
