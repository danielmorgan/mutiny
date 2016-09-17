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
                    <p>{{ $ship->description }}</p>
                    <img src="{{ $ship->image }}" class="img-responsive">

                    <hr>

                    <h3>Debug Controls</h3>
                    <form action="{{ route('ship.power-toggle') }}" method="POST">
                        <button type="submit" class="btn btn-danger">Toggle Power</button>
                    </form>

                    <hr>

                    <h3>Resources</h3>
                    <dl class="dl-horizontal">
                        <dt>Hull</dt>
                        <dd>{{ number_format($ship->resource->hull) }}</dd>
                        <dt>Armor</dt>
                        <dd>{{ number_format($ship->resource->armor) }}</dd>
                        <dt>Propellant</dt>
                        <dd>{{ number_format($ship->resource->propellant) }}</dd>
                        <dt>Fuel</dt>
                        <dd>{{ number_format($ship->resource->fuel) }}</dd>
                        <dt>Energy</dt>
                        <dd>{{ number_format($ship->resource->energy) }} (<em>{{ $ship->resourceUsage->energy }}/min</em>)</dd>
                    </dl>

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
