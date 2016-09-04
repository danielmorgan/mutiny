<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\MoveToRoom;
use App\Ships\Ship;
use App\Rooms\Room;
use App\User;
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
     * @param \App\User $user
     * @return \Illuminate\View\View
     */
    public function profile(User $user)
    {
        if (! $user->exists) {
            $user = Auth::user();
        }

        return view('profile', compact('user'));
    }

    /**
     * @return \Illuminate\View\View
     */
    public function location()
    {
        $location = Auth::user()->location->parent;

        switch ($location->locatable_type) {
            case Ship::class:
                return view('ship')->with(['ship' => $location->locatable]);
                break;
            case Room::class:
                return view('room')->with(['room' => $location->locatable]);
                break;
            default:
                return view('location')->with(compact('location'));
        }
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Rooms\Room $room
     * @return \Illuminate\Http\RedirectResponse
     */
    public function moveToRoom(Request $request, Room $room)
    {
        $job = new MoveToRoom(Auth::user(), $room);
        dispatch($job);

        $request->session()->flash('info', "You scramble through the corridors and maintenance shafts of the ship. You estimate you will reach the $room $job->when.");

        return redirect()->back();
    }
}
