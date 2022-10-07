<?php

namespace App\Models\DTO;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class GroupDTO implements IDTO
{

    public static function fromModel(Model $model)
    {
        return [
          'id' => $model->id,
          'letter' => $model->letter
        ];
    }

    public static function fromRequest(Request $request)
    {

    }
}
