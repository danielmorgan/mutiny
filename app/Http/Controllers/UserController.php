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

    public function settings()
    {
        return view('settings');
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

        $data['location'] = $location;
        $data['template'] = 'locations/generic';
        $data['locatableData'] = [];

        if ($location->isLocatable()) {
            $type = str_slug(class_basename($location->locatable));
            $data['template'] = "locations/$type";
            $data['locatableData'] = [$type => $location->locatable];
        }

        return view('location')->with($data);
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

        return redirect(route('location'));
    }
}
