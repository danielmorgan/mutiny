<?php

namespace App\Ships;

class ShipObserver
{
    public function created(Ship $ship)
    {
        $resources = collect(Resource::$types)->map(function($resource) use ($ship) {
            return [$resource => Ship::$resourceMax[$resource]];
        })->collapse();

        $ship->resource()->create($resources->toArray());
    }
}
