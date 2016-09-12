<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\CancelledMoveToRoom;
use App\Http\Requests\MoveUser;
use App\Jobs\MoveToRoom;
use App\Jobs\MoveToShip;
use App\Jobs\MoveToLocation;
use App\Rooms\Room;
use App\Ships\Ship;
use App\Location;
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
     * @param \App\Http\Requests\MoveUser $request
     * @param \App\Location $location
     * @return \Illuminate\Http\RedirectResponse
     */
    public function move(MoveUser $request, Location $location)
    {
        if ($location->isLocatable()) {
            if ($location->locatable instanceof Room) {
                dispatch(new MoveToRoom(Auth::user(), $location->locatable));
                return redirect(route('location'));
            }

            if ($location->locatable instanceof Ship) {
                dispatch(new MoveToShip(Auth::user(), $location->locatable));
                return redirect(route('location'));
            }
        }

        dispatch(new MoveToLocation(Auth::user(), $location));
        return redirect(route('location'));

    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function cancelMove()
    {
        event(new CancelledMoveToRoom(Auth::user()));

        return redirect(route('location'));
    }
}
