@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-default">
                    <div class="panel-heading">Ship</div>

                <div class="panel-body">
                    <h2>{{ $ship->name }}</h2>
                    <div class="location">
                        <p><strong>Current Location:</strong> {{ $ship->locatedIn->name }}</p>
                    </div>

                    <hr>

                    <h3>Rooms <small>({{ count($ship->rooms) }})</small></h3>
                    <ul>
                        @foreach ($ship->rooms as $room)
                            <li class="room">
                                @if (Auth::user()->isInRoom($room))
                                    <div class="name"><strong>{{ $room }}</strong></div> (You are here)
                                @else
                                    <div class="name"><strong>{{ $room }}</strong></div>
                                @endif
                            </li>
                        @endforeach
                    </ul>

                    <hr>

                    <h3>Crew <small>({{ count($ship->crew) }})</small></h3>
                    <ul>
                        @foreach ($ship->crew as $user)
                            <li>
                                <a href="@if ($user->isYou()) {{ route('profile') }} @else {{ route('profile', ['user' => $user]) }} @endif">
                                    {{ $user->name }}</a>
                                    @if ($user->isYou()) <strong>(You)</strong> @endif</li>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
