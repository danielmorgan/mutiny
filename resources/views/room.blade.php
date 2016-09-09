@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">Room</div>

                <div class="panel-body">
                    <h2>{{ $room }}</h2>
                    <div class="location">
                        <p>
                            <strong>Ship:</strong>
                            <a href="{{ route('ship') }}">{{ $room->ship }}</a>
                        </p>
                    </div>
                    <p>{{ $room->location->description }}</p>
                    <img src="{{ $room->location->image }}" class="img-responsive">

                    <hr>

                    <h3>Computers</h3>
                    <div class="alert alert-warning">It looks like the IT guys haven't installed any System Interface Computers yet.</div>

                    <hr>

                    <h3>Occupants</h3>
                    <ul>
                        @foreach ($room->occupants as $user)
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
