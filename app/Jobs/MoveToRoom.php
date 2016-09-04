<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Carbon\Carbon;
use App\Rooms\Room;
use App\User;
use Log;

class MoveToRoom extends DeferredAction implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var int
     */
    public $duration = 20;

    /**
     * @var \App\User
     */
    private $user;

    /**
     * @var \App\Rooms\Room
     */
    private $room;

    /**
     * Create a new job instance.
     *
     * @param \App\User $user
     * @param \App\Rooms\Room $room
     * @param int $delay
     */
    public function __construct(User $user, Room $room, $delay = null)
    {
        $this->room = $room;
        $this->user = $user;

        // Move the user to the ship corridors right away
        Log::info('moving user to ship corridors', $this->user->ship->toArray());
        $this->user->moveTo($this->user->ship->location);

        $this->delay(Carbon::now()->addSeconds($this->duration));
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->user->moveTo($this->room->location);
    }
}
