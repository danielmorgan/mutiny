<?php

namespace App\Ships;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Locatable;
use App\Location;
use App\Ships\Rooms\Room;

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

    static public function boot()
    {
        static::created(function($ship) {
            // Put new ship the Universe
            $location = new Location([
                'locatable_id' => $ship->id,
                'locatable_type' => Ship::class,
                'parent_id' => 1,
            ]);
            $ship->location()->save($location);

            (new Location([
                'name' => null,
                'locatable_id' => null,
                'locatable_type' => \App\Ships\Rooms\OperationsRoom::class,
                'parent_id' => $ship->location->id,
            ]))->save();

            (new Location([
                'name' => null,
                'locatable_id' => null,
                'locatable_type' => \App\Ships\Rooms\EngineeringRoom::class,
                'parent_id' => $ship->location->id,
            ]))->save();
        });
    }
}
