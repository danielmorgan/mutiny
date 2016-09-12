<?php

namespace App\Listeners;

use App\Events\UserLeftRoom;
use App\Notifications\UserLeftRoomNotification;

class SendUserLeftRoomNotifications
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
     * @param  UserLeftRoom  $event
     */
    public function handle(UserLeftRoom $event)
    {
        $event->room->notifyExcept(new UserLeftRoomNotification($event->user, $event->room), $event->user);
    }
}
