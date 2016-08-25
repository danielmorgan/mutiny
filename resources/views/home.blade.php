@extends('layouts.app')

@section('content')
<div class="container">
    {{--Push Notifications--}}
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Push Notifications</div>
                <div class="panel-body">
                    {{ dump(Auth::user()->getAttributes()) }}
                </div>
            </div>
        </div>
    </div>

    {{--Settings--}}
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Settings</div>
                <div class="panel-body">
                    <push-notifications-toggle></push-notifications-toggle>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
