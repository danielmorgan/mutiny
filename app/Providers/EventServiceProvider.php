<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\UserLeftRoom' => [
            'App\Listeners\SendUserLeftRoomNotifications',
        ],
        'App\Events\UserEnteredRoom' => [
            'App\Listeners\SendUserEnteredRoomNotifications',
        ],
        'App\Events\UserEnteredLocation' => [
            'App\Listeners\SendUserEnteredLocationNotifications'
        ],
        'App\Events\UserChangedDestinationRoom' => [
            'App\Listeners\SendUserChangedDestinationRoomNotifications',
            'App\Listeners\DeleteExistingMoveToRoomJobs',
        ],
        'App\Events\CancelledMoveToRoom' => [
            'App\Listeners\SendUserCancelledMoveToRoomNotifications',
            'App\Listeners\DeleteExistingMoveToRoomJobs',
        ],
        'App\Events\UserChangedDestination' => [
            'App\Listeners\DeleteExistingMoveToRoomJobs',
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
