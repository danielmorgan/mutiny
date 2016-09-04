<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rooms\Room;
use App\Ships\Ship;
use Auth;

class ShipController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @param \App\Ships\Ship $ship
     * @return $this
     */
    public function ship(Ship $ship)
    {
        if (! $ship->exists) {
            $ship = Auth::user()->ship;
        }

        return view('ship')->with(compact('ship'));
    }

    public function location()
    {
        dump(Auth::user()->location->toArray());
        dd(Auth::user()->location->locatable->toArray());
    }

    /**
     * @return $this
     */
    public function room()
    {
        $room = Auth::user()->room->first();

        return view('room')->with(compact('room'));
    }
}
