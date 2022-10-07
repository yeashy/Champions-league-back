<?php

namespace App\Jobs;

use App\Models\Game;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AddGameJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private int $tries = 5;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        private int $homeId,
        private int $awayId,
        private int $stageId,
        private ?int $groupId = null
    ) {  }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $game = new Game();
        $game->home_club_id = $this->homeId;
        $game->away_club_id = $this->awayId;
        $game->stage_id = $this->stageId;
        $game->group_id = $this->groupId;
        $game->save();
    }
}
