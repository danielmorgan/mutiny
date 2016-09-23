<?php

namespace App\Jobs;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Events\UserChangedDestinationRoom;
use App\Events\UserEnteredRoom;
use App\Events\UserLeftRoom;
use App\User;
use App\Rooms\Room;

class MoveToRoom extends UserMove implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var int
     */
    public $duration = 10;

    /**
     * @var string
     */
    public $description;

    /**
     * @var string
     */
    public $completedUrl;

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
        $this->completedUrl = route('location');

        $this->location = $room;
        $this->room = $room;
        $this->user = $user;

        // Set description to be shown on the page
        $this->description = "You scramble through the corridors and maintenance shafts of the ship, heading towards the {$room}.";

        // Cancel any in progress MoveToRoom actions and notify the user
        if ($this->user->isMovingToARoom()) {
            event(new UserChangedDestinationRoom($this->user, $this->room));
        }

        // Fire an event saying User left their current room
        if ($this->user->isInARoom()) {
            event(new UserLeftRoom($this->user, $this->user->room->first()));
        }

        // Move the user to the current ship corridors right away
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
