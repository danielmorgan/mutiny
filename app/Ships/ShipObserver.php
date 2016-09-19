<?php

namespace App\Ships;

class ShipObserver
{
    public function created(Ship $ship)
    {
        $ship->resource()->create([
            'hull' => Ship::$resourceMax['hull'],
            'armor' => Ship::$resourceMax['armor'],
            'propellant' => Ship::$resourceMax['propellant'],
            'fuel' => Ship::$resourceMax['fuel'],
            'energy' => Ship::$resourceMax['energy'] / 2,
        ]);
    }
}
