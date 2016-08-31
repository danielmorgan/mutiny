<?php

namespace App;

trait Locatable
{
    public function location()
    {
        return $this->morphOne(Location::class, 'locatable');
    }

    /**
     * Set an accessor that returns a collection of Locatable entities.
     *
     * @return \App\Locatable
     */
    public function getOccupantsAttribute()
    {
        return $this->location->children->transform(function($child) {
            return $child->locatable;
        });
    }
}
