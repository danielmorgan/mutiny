@extends('layouts.app')

@section('content')
    {{--User Profile--}}
    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-default panel-wallet">
                <div class="panel-heading">@if ($user->isYou()) Your @endif Crew Profile</div>

                <div class="panel-body">
                    <h2>{{ $user->name }}</h2>
                    <dl class="dl-horizontal">
                        @foreach($user->toArray() as $key => $value)
                            <dt>{{ $key }}</dt>
                            <dd>{{ $value }}</dd>
                        @endforeach
                    </dl>

                    @if ($user->isYou())
                        <hr>

                        <h3>Current Location</h3>
                        <p>
                            <a href="{{ route('location') }}">{{ $user->location->parent }}</a>
                        </p>

                        <hr>

                        <h3>Notifications</h3>
                        @include ('interfaces.notifications')
                    @endif
            </div></div>
        </div>
    </div>
@endsection
