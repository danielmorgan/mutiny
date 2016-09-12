<?php

namespace App\Listeners;

use App\Notifications\FinishedMovingToRoomNotification;
use App\Notifications\UserEnteredRoomNotification;

class SendUserEnteredRoomNotifications
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
     * @param $event
     */
    public function handle($event)
    {
        $event->user->notify(new FinishedMovingToRoomNotification($event->room));
        $event->room->notifyExcept(new UserEnteredRoomNotification($event->user, $event->room), $event->user);
    }
}
