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

                    <h3>Rooms</h3>
                    @foreach ($ship->rooms as $room)
                        <div class="room">
                            @if (Auth::user()->isInRoom($room))
                                <a href="{{ route('location') }}">
                                    <h4 class="name"><strong>{{ $room->type }}</strong></h4>
                                </a>
                                (You are here)
                            @else
                                <h4 class="name"><strong>{{ $room->type }}</strong></h4>
                                <form action="{{ route('move.user.room', ['room' => $room]) }}" method="POST" class="move">
                                    <button type="submit" class="btn btn-sm btn-success">
                                        Move to - <i class="fa fa-clock-o"></i> 30s
                                    </button>
                                </form>
                            @endif
                        </div>
                    @endforeach

                    <hr>

                    <h3>Crew</h3>
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
