<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Carbon\Carbon;
use App\Events\UserEnteredRoom;
use App\Events\UserLeftRoom;
use App\User;
use App\Rooms\Room;

class MoveToRoom extends DeferredAction implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var int
     */
    public $duration = 15;

    /**
     * @var \App\User
     */
    public $user;

    /**
     * @var \App\Rooms\Room
     */
    public $room;

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

        // Fire an event saying User left their current room
        event(new UserLeftRoom($this->user, $this->user->room->first()));

        // Move the user to the ship corridors right away
        $this->user->moveTo($this->user->ship->location);

        // Set a delay
        $this->delay(Carbon::now()->addSeconds($this->duration));
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        // Move user to their intended room after delay
        $this->user->moveTo($this->room->location);

        // Fire an event saying User entered the room
        event(new UserEnteredRoom($this->user, $this->room));
    }
}
