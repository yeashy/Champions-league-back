<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $letter
 * @property int $id
 */
class Group extends Model
{
    use HasFactory;

    function clubs()
    {
        return $this->hasMany(Club::class)->orderBy('group_place')->orderBy('pot_id');
    }

    function games()
    {
        return $this->hasMany(Game::class);
    }
}
