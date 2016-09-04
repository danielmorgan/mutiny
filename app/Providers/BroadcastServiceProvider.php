<?php

namespace App\Providers;

use App\Ships\Ship;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Broadcast;
use App\User;
use App\Rooms\Room;

class BroadcastServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Broadcast::routes();

        /*
         * Authenticate the user's personal channel...
         */
        Broadcast::channel('user.*', function ($user, $userId) {
            return (int) $user->id === (int) $userId;
        });

        /**
         * Authenticate a ship's channel...
         */
        Broadcast::channel('ship.*', function (User $user, $shipId) {
            if ($user->isInShip(Ship::find($shipId))) {
                return ['id' => $user->id, 'name' => $user->name];
            }
        });

        /**
         * Authenticate a room's channel...
         */
        Broadcast::channel('room.*', function (User $user, $roomId) {
            if ($user->isInRoom(Room::find($roomId))) {
                return ['id' => $user->id, 'name' => $user->name];
            }
        });
    }
}
