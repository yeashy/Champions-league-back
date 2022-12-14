<?php

use App\Http\Controllers\ClubController;
use App\Http\Controllers\ClubCrudController;
use App\Http\Controllers\FormationController;
use App\Http\Controllers\GameCrudController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\PlayerCrudController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\PotController;
use App\Http\Controllers\StageController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\TeamOfTheWeekController;
use App\Http\Controllers\VideoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::controller(FormationController::class)->group(function () {
    Route::get('/formations', 'getFormations');
    Route::get('/formations/{id}', 'getPositions');
});

Route::controller(GroupController::class)->group(function () {
    Route::get('/groups', 'getClubs');
    Route::patch('/groups/make', 'addClubsToGroups');
});

Route::controller(PositionController::class)->group(function () {
    Route::get('positions/{id}/players', 'getPlayers');
});

Route::controller(PotController::class)->group(function () {
    Route::get('/pots', 'getClubs');
});

Route::controller(TeamOfTheWeekController::class)->group(function () {
    Route::get('/totw/{id}', 'read');
    Route::post('/totw', 'create');
});

Route::controller(VideoController::class)->group(function () {
    Route::get('/videos', 'getVideos');
    Route::get('/videos/best', 'getBestVideo');
});

Route::controller(StageController::class)->group(function () {
    Route::get('/stage/active', 'getActiveStage');
    Route::get('/stage/game', 'getNextGame');
    Route::post('/stage/shuffle/group', 'makeGroupShuffle');
    Route::post('/stage/shuffle/playoff', 'makePlayOffShuffle');
});

Route::controller(ClubController::class)->group(function () {
    Route::get('/clubs/{id}/players', 'getPlayers');
    Route::get('/clubs', 'getClubList');
    Route::patch('/clubs/swap/groups', 'swapGroups');
    Route::patch('/clubs/swap/pots', 'swapPots');
});

Route::controller(PlayerController::class)->group(function () {
    Route::get('/players/{id}/stats', 'showPlayerStats');
    Route::get('/players/rating', 'sortBy');
    Route::get('/players/position/good', 'getForTeamOfTheWeek');
    Route::patch('/players/swap', 'swap');
});

Route::controller(TableController::class)->group(function () {
    Route::get('/table/{stageId}', 'getTable');
});

Route::controller(PlayerCrudController::class)->group(function () {
    Route::get('/players/{id}', 'read');
    Route::post('/players/create', 'create');
    Route::patch('/players/{id}', 'update');
    Route::delete('/players/{id}', 'delete');
});

Route::controller(ClubCrudController::class)->group(function () {
    Route::get('/clubs/{id}', 'read');
    Route::post('/clubs/create', 'create');
    Route::patch('/clubs/{id}', 'update');
    Route::delete('/clubs/{id}', 'delete');
});

Route::controller(GameCrudController::class)->group(function () {
    Route::get('/games/{id}', 'read');
    Route::post('/games/create', 'create');
    Route::patch('/games/{id}', 'update');
});
