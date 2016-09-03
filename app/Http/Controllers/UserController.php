<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rooms\Room;
use Auth;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Rooms\Room $room
     * @return \Illuminate\Http\RedirectResponse
     */
    public function moveToRoom(Request $request, Room $room)
    {
        Auth::user()->moveTo($room->location);

        $request->session()->flash('info', 'Moved.');

        return redirect()->back();
    }
}
