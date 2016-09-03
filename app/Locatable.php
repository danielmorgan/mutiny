<?php

namespace App;

trait Locatable
{
    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function location()
    {
        return $this->morphOne(Location::class, 'locatable');
    }


    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

    /**
     * @return \App\LocatableCollection
     */
    public function getOccupantsAttribute()
    {
        return $this->location->children()->with('locatable')->get()->transform(function($child) {
            return $child->locatable;
        });
    }

    /**
     * @return \App\Locatable
     */
    public function getLocatedInAttribute()
    {
        if (! $this->location->parent->isLocatable()) {
            return $this->location->parent;
        }

        return $this->location->parent->locatable;
    }


    /*
    |--------------------------------------------------------------------------
    | Observers
    |--------------------------------------------------------------------------
    */

    public static function bootLocatable()
    {
        static::created(function($locatable) {
            $locatable->location()->create([
                'locatable_id' => $locatable->id,
                'locatable_type' => get_class($locatable),
                'parent_id' => Location::where('locatable_id', $locatable->parent_id)->firstOrFail()->id,
            ]);
        });
    }
}
