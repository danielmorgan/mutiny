<?php

namespace App\Jobs;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Events\UserChangedDestination;
use App\Events\UserEnteredLocation;
use App\User;
use App\Location;

class MoveToLocation extends UserMove implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var int
     */
    public $duration = 20;

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
     * Create a new job instance.
     *
     * @param \App\User $user
     * @param \App\Location $location
     * @param int $delay
     */
    public function __construct(User $user, Location $location, $delay = null)
    {
        $this->user = $user;
        $this->location = $location;
        if (! is_null($delay)) $this->duration = $delay;

        // Set description to be shown on the page and redirect url
        $this->description = "You head towards the {$location}.";
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
        $this->user->moveTo($this->location);

        // Fire an event saying User entered the Location
        event(new UserEnteredLocation($this->user, $this->location));
    }
}
