<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Location;
use Auth;

class LocationController extends Controller
{
    public function moveSelfToRoom(Request $request, Location $location)
    {
        Auth::user()->location->parent_id = $location->id;
        Auth::user()->location->save();

        $request->session()->flash('info', 'Moved.');

        return redirect()->back();
    }
}
