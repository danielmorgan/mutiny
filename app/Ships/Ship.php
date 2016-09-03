<?php

namespace App\Ships;

use Illuminate\Database\Eloquent\Model;
use App\Locatable;
use App\Location;
use App\User;
use App\Rooms\OperationsRoom;
use App\Rooms\EngineeringRoom;

class Ship extends Model
{
    use Locatable;

    /**
     * @var array
     */
    protected $fillable = ['name'];


    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function crew()
    {
        return $this->hasMany(User::class);
    }

    /**
     * @return mixed
     */
    public function rooms()
    {
        $roomClasses = Location::where([
            ['locatable_type', 'like', '%Room'],
            ['parent_id', $this->location->id],
        ])->get()->instantiables();

        // New up instances of rooms each time
        $rooms = $roomClasses->map(function($room) {
            return new $room($this);
        });

        return $rooms;
    }


    /*
    |--------------------------------------------------------------------------
    | Observers
    |--------------------------------------------------------------------------
    */

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

            // Put two rooms in ship
            (new Location([
                'name' => null,
                'locatable_id' => null,
                'locatable_type' => OperationsRoom::class,
                'parent_id' => $ship->location->id,
            ]))->save();

            (new Location([
                'name' => null,
                'locatable_id' => null,
                'locatable_type' => EngineeringRoom::class,
                'parent_id' => $ship->location->id,
            ]))->save();
        });
    }
}
