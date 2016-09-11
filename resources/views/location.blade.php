@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">Current Location</div>

                <div class="panel-body">
                    <h2>{{ $location }}</h2>
                    <div class="parent-location">
                        <p>
                            <strong>Inside of:</strong>
                            {{ $location->parent or 'It\'s turtles all the way down from here' }}
                        </p>
                    </div>
                    <p>{{ $location->description }}</p>
                    <img src="{{ $location->image }}" class="img-responsive">

                    <hr>

                    @include($template, $locationData)
                </div>
            </div>
        </div>
    </div>
@endsection
