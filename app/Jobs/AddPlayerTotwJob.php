<?php

namespace App\Jobs;

use App\Models\Position;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AddPlayerTotwJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private int $tries = 5;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        private array $player,
        private int $teamId
    ) { }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            DB::table('player_team_of_the_week')->insert([
                'player_id' => $this->player['player_id'],
                'position_id' => $this->player['position_id'],
                'position_name' => Position::find($this->player['position_id'])->first()->name,
                'team_of_the_week_id' => $this->teamId
            ]);
            Log::info("Player " . $this->player['player_id'] . " successfully added to totw " . $this->teamId);
        } catch (\Throwable $e) {
            Log::error("Something went wrong when adding player "  . $this->player['player_id'] . ". Message: " . $e->getMessage());
        }
    }
}
