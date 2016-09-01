<?php

namespace App\Ships;

use Illuminate\Database\Eloquent\Model;
use App\Locatable;
use App\Location;
use App\Ships\Rooms\Room;
use App\Ships\Rooms\EngineeringRoom;

class Ship extends Model
{
    use Locatable;

    protected $fillable = ['name'];

    public function rooms()
    {
        $rooms = Location::where([
            ['locatable_type', 'like', '%Room'],
            ['parent_id', $this->location->id],
        ])->get()->locatables();

        return $rooms;
    }
}
