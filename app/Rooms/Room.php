<?php

namespace App\Rooms;

use Illuminate\Database\Eloquent\Model;
use App\Locatable;
use App\Ships\Ship;

class Room extends Model
{
    use Locatable;

    public function ship()
    {
        return $this->hasManyThrough(Ship::class, Location::class, 'locatable_id');
    }
}
