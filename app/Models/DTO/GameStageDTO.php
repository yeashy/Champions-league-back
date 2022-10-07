<?php

namespace App\Models\DTO;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class GameStageDTO implements IDTO
{

    public static function fromModel(Model $model)
    {
        return [
            'id' => $model->id,
            'name' => $model->name
        ];
    }

    public static function fromRequest(Request $request)
    {

    }
}
