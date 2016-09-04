<?php

namespace App\Listeners;

use App\Events\UserEnteredRoom;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\FinishedMovingToRoomNotification;

class NotifyRoomOccupantsThatUserEntered
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserEnteredRoom  $event
     * @return void
     */
    public function handle(UserEnteredRoom $event)
    {
        $event->user->notify(new FinishedMovingToRoomNotification($event->room));
    }
}
