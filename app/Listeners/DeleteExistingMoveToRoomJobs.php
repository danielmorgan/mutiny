<?php

namespace App\Listeners;

class DeleteExistingMoveToRoomJobs
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
        $event->user->jobs()->moveToRoom()->get()->each(function($job) {
            $job->delete();
        });
    }
}
