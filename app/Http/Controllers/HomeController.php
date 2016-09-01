<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Location;
use App\Ship;

class HomeController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function admin()
    {
        return view('admin');
    }

    public function locations()
    {
        $ship = Ship::first();
        // $locations = Location::getTree($ship->location);
        $locations = Location::getTree();
        dd($locations);

        return view('locations')->with(compact('locations'));
    }
}
