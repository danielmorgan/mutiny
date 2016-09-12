<?php

namespace App\Listeners;

use App\Events\CancelledMoveToRoom;
use App\Notifications\StoppedMovingToRoomNotification;

class SendUserCancelledMoveToRoomNotifications
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
     * @param  CancelledMoveToRoom  $event
     */
    public function handle(CancelledMoveToRoom $event)
    {
        if ($event->user->isMovingToARoom()) {
            $oldTarget = $event->user->jobs()->moveToRoom()->get()->first()->action->room;

            $event->user->notify(new StoppedMovingToRoomNotification($oldTarget));
        }
    }
}
