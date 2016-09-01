<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Location;
use Auth;

class LocationController extends Controller
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

    public function moveSelfToRoom(Request $request, Location $location)
    {
        Auth::user()->location->parent_id = $location->id;
        Auth::user()->location->save();

        $request->session()->flash('info', 'Moved.');

        return redirect()->back();
    }
}
