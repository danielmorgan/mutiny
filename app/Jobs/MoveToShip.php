<?php

namespace App\Jobs;

use App\Ships\Ship;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;

class MoveToShip extends UserMove implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var int
     */
    public $duration = 5 * 60;

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
     * @var \App\Ships\Ship
     */
    private $ship;

    /**
     * Create a new job instance.
     *
     * @param \App\User $user
     * @param \App\Ships\Ship $ship
     * @param int $delay
     */
    public function __construct(User $user, Ship $ship, $delay = null)
    {
        $this->location = $ship;
        $this->ship = $ship;
        $this->user = $user;
        if (! is_null($delay)) $this->duration = $delay;

        // Set description to be shown on the page and redirect url
        $this->description = "You start boarding the {$ship}.";
        $this->completedUrl = route('location');

        // Cancel any in progress MoveToRoom actions and notify the user
        if ($this->user->isMoving()) {
            event(new UserChangedDestination($this->user));
        }

        // Set a delay
        $this->delay(Carbon::now()->addSeconds($this->duration));
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        // Move user to their intended room after delay
        $this->user->moveTo($this->ship->location);
    }
}
