<?php

namespace App;

use App\User;
use App\Ships\Ship;
use App\Rooms\Room;

class UserObserver
{
    public function creating(User $user)
    {
        // Set the default balance
        $user->balance = 6000;

        // Place the user on a ship crew
        $user->ship()->associate(Ship::first());
    }
}
