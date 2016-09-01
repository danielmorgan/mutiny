<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ships\Ship;
use Auth;

class ShipController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function page()
    {
        $ship = Auth::user()->ship;

        return view('locations.ship')->with(compact('ship'));
    }
}
