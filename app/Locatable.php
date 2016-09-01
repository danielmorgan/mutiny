<?php

namespace App;

trait Locatable
{
    /**
     * Eloquent observers.
     */
    public static function bootLocatable()
    {
        static::created(function($locatable) {
            $locatable->location()->create([
                'locatable_id' => $locatable->id,
                'locatable_type' => get_class($locatable),
            ]);
        });
    }

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
