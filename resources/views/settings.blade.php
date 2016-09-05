@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-default panel-wallet">
                <div class="panel-heading">Settings</div>

                <div class="panel-body">
                    <h2>Notifications</h2>
                    <notifications-settings></notifications-settings>
                </div>
            </div>
        </div>
    </div>
@endsection
