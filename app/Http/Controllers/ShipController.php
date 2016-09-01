<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ship;

class ShipController extends Controller
{
    public function page()
    {
        $ship = Ship::first();
        $occupants = $ship->occupants;

        return view('locations.ship')->with(compact('ship', 'occupants'));
    }
}
