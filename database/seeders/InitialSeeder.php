<?php

namespace Database\Seeders;

use App\Enums\Ampluas;
use App\Enums\NumOfClubs;
use App\Models\Club;
use App\Models\Formation;
use App\Models\Game;
use App\Models\Group;
use App\Models\Player;
use App\Models\Position;
use App\Models\Pot;
use App\Models\Stage;
use App\Models\Video;
use Illuminate\Database\Seeder;

class InitialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $this->createPlayer();
        $this->createVideo();
    }

    private function createPlayer()
    {
        $player = new Player();
        $player->name = "Jack";
        $player->surname = "Grealish";
        $player->photo = "path/to/photo/Grealish.webp";
        $player->club_id = 1;
        $player->position_id = 1;
        $player->save();

        $player = new Player();
        $player->name = "Karim";
        $player->surname = "Benzema";
        $player->photo = "path/to/photo/Benzema.webp";
        $player->club_id = 2;
        $player->position_id = 2;
        $player->save();
    }

    private function createVideo()
    {
        $video = new Video();
        $video->game_id = 1;
        $video->path = "path/to/video/123.mp4";
        $video->save();
    }
}
