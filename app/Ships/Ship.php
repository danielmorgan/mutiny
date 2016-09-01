<?php

namespace App\Ships;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Locatable;
use App\Location;
use App\Ships\Rooms\Room;
use App\Ships\Rooms\EngineeringRoom;

class Ship extends Model
{
    use Locatable;

    protected $fillable = ['name'];

    public function crew()
    {
        return $this->hasMany(User::class);
    }

    public function rooms()
    {
        $roomClasses = Location::where([
            ['locatable_type', 'like', '%Room'],
            ['parent_id', $this->location->id],
        ])->get()->instantiables();

        // New up instances of rooms
        $rooms = $roomClasses->map(function($room) {
            return new $room($this);
        });

        return $rooms;
    }
}
