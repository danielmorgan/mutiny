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
    public function ship(Ship $ship = null)
    {
        if (! $ship->exists) {
            $ship = Auth::user()->ship;
        }

        return view('ship')->with(compact('ship'));
    }

    public function getLocation() {
        return Auth::user()->ship->location->parent;
    }

    public function togglePower(Request $request)
    {
        if (Auth::user()->ship->resourceUsage->energy !== 0) {
            Auth::user()->ship->resourceUsage->energy = 0;
            $state = 'off';
        } else {
            Auth::user()->ship->resourceUsage->energy = -100;
            $state = 'on';
        }

        Auth::user()->ship->resourceUsage->save();

        $request->session()->flash('success', "Power has been turned <strong>$state</strong> across the entire ship.");

        return redirect()->back();
    }

    public function testThrusters(Request $request)
    {
        Auth::user()->ship->resource->propellant -= 100;

        Auth::user()->ship->resource->save();

        $request->session()->flash('success', 'Reaction control thruster test fire sequence complete. 100 units of propellant depleted.');

        return redirect()->back();
    }
}
