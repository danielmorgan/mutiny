<?php

namespace App\Listeners;

use App\Events\UserLeftRoom;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyRoomOccupantsThatUserLeft
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
     * @return void
     */
    public function handle(UserLeftRoom $event)
    {
        //
    }
}
