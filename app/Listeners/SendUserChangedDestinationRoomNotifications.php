<?php

namespace App\Listeners;

use App\Events\UserChangedDestinationRoom;
use App\Notifications\ChangedTargetRoomNotification;

class SendUserChangedDestinationRoomNotifications
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
     * @param  UserChangedDestinationRoom  $event
     */
    public function handle(UserChangedDestinationRoom $event)
    {
        if ($event->user->isMovingToARoom()) {
            $newTarget = $event->newTarget;
            $oldTarget = $event->user->jobs()->moveToRoom()->get()->first()->action->room;
            
            $event->user->notify(new ChangedTargetRoomNotification($newTarget, $oldTarget));
        }
    }
}
