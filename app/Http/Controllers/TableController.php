<?php

namespace App\Http\Controllers;

use App\Models\Stage;
use App\Services\TableService;

class TableController extends Controller
{
    public function getTable($stageId, TableService $service)
    {
        $stage = Stage::find($stageId);

        if ($stage === null) {
            return response()->json([
                "message" => "Id is unavailable"
            ])->setStatusCode(404);
        }

        if ($stageId < 7) {
            return response()->json($service->getGroupTable());
        }

        return response()->json($service->getPlayoffTable(Stage::find($stageId)));
    }
}
