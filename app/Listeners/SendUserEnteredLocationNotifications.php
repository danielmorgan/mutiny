<?php

namespace App\Listeners;

use App\Events\UserEnteredLocation;
use App\Notifications\HelloNotification;

class SendUserEnteredLocationNotifications
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
     * @param  UserEnteredLocation  $event
     * @return void
     */
    public function handle(UserEnteredLocation $event)
    {
        // @todo Make real notification
        $event->user->notify(new HelloNotification());
    }
}
