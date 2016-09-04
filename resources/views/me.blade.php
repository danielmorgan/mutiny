@extends('layouts.app')

@section('content')
    {{--User Profile--}}
    <div class="row">
        <div class="col-xs-12">
            @include('interfaces.profile', ['user' => Auth::user()])
        </div>
    </div>
@endsection
