<?php

namespace App;

trait Locatable
{
    public function location()
    {
        return $this->morphOne(Location::class, 'locatable');
    }

    public function relocate(Locatable $locatable)
    {
        $this->location()->save($locatable);
    }
}
