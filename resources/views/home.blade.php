@extends('layouts.app')

@section('content')
<div class="container">
    {{--Push Notifications--}}
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Push Notifications</div>
                <div class="panel-body">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A ab aliquid at autem consectetur eius eveniet ex <a href="#">excepturi fuga</a> id iure labore laudantium minus, nisi quaerat quo, sit ut, vel.</p>
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
