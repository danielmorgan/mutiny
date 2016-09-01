<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ships\Ship;

class ShipController extends Controller
{
    public function page()
    {
        $ship = Ship::first();

        return view('locations.ship')->with(compact('ship'));
    }
}
