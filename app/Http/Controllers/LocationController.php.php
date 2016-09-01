<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function moveSelf(Request $request, Location $location)
    {
        $this->move(Auth::user(), $location);
    }

    public function move(Request $request, $locatable, Location $location)
    {
        $locatable->location->parent_id = $location->id;
        $locatable->location->save();

        $requestion->session()->flash('info', 'Moved ' . $locatable->name . ' to ' . $location->name .'.');

        return redirect()->back();
    }
}
