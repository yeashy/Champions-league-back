<?php

namespace App\Models\DTO;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class PositionDTO implements IDTO
{

    public static function fromModel(Model $position)
    {
        return [
            "id" => $position->id,
            "amplua" => $position->amplua,
            "name" => $position->name,
            "quantity" => $position->quantity
        ];
    }

    public static function fromRequest(Request $request)
    {

    }
}
