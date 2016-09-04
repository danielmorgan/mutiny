<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Carbon\Carbon;
use App\Rooms\Room;
use App\User;

class MoveToRoom extends DeferredAction implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var int
     */
    public $duration = 5;

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
     */
    public function __construct(User $user, Room $room)
    {
        $this->room = $room;
        $this->user = $user;

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
