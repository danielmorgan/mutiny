<?php

namespace App\Ships\Rooms;

use App\Ships\Ship;
use App\Location;
use App\User;

abstract class Room
{
    public $location;

    public $ship;

    public $occupants;

    public function __construct(Ship $ship)
    {
        $this->ship = $ship;
        $this->location = $this->findLocation();
        $this->occupants = $this->findOccupants();
    }

    /**
     * Find the existing location for the current Room.
     *
     * @return \App\Location
     */
    public function findLocation()
    {
        return Location::where([
            ['locatable_type', get_called_class()],
            ['parent_id', $this->ship->location->id],
        ])->get()->first();
    }

    /**
     * Find Users in this room.
     *
     * @return Collection
     */
    public function findOccupants()
    {
        return Location::where([
            ['locatable_type', User::class],
            ['parent_id', $this->location->id],
        ])->get()->locatables();
    }

    public function __toString()
    {
        return (string) $this->location->id;
    }
}
