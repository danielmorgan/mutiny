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

                    @foreach ($ship->rooms() as $room)
                        @include('locations.room', compact('room'))
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
