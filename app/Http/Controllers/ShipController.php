<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
     * @return \Illuminate\View\View
     */
    public function ship(Ship $ship)
    {
        if (! $ship->exists) {
            $ship = Auth::user()->ship;
        }

        return view('ship')->with(compact('ship'));
    }
}
