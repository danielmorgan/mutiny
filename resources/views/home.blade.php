@extends('layouts.app')

@section('content')
<div class="container">

    {{--Map--}}
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Map</div>

                <div class="panel-body">
                    @foreach ($locations as $location)
                        <div class="row">
                            <div class="col-xs-6">
                                <h4>Location</h4>
                                <div class="well" style="padding: 5px">
                                    <dl class="dl-horizontal" style="padding: 0; margin: 0;">
                                        <dt>id</dt>
                                        <dd>{{ $location->id }}</dd>
                                        @if (isset($location->name))
                                            <dt>name</dt>
                                            <dd>{{ $location->name }}</dd>
                                        @endif
                                        @if (isset($location->locatable_id))
                                            <dt>locatable_id</dt>
                                            <dd>{{ $location->locatable_id }}</dd>
                                        @endif
                                        @if (isset($location->locatable_type))
                                            <dt>locatable_type</dt>
                                            <dd>{{ $location->locatable_type }}</dd>
                                        @endif
                                    </dl>
                                </div>
                            </div>
                            @if (isset($location->locatable))
                                <div class="col-xs-6">
                                    <h4>Locatable (Ship, User etc.)</h4>
                                    <div class="well" style="padding: 5px">
                                        <dl class="dl-horizontal" style="padding: 0; margin: 0;">
                                            <dt>id</dt>
                                            <dd>{{ $location->locatable->id }}</dd>
                                            <dt>name</dt>
                                            <dd>{{ $location->locatable->name }}</dd>
                                        </dl>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    {{--Wallet--}}
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @include('interfaces.wallet')
        </div>
    </div>

    {{--Push Notifications--}}
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Notifications</div>

                <div class="panel-body text-center">
                    <notifications inline-template>
                        <button type="btn" class="btn btn-success btn-send" :disabled="loading" @click="sendNotification">
                            Send Notification
                        </button>

                        <button type="btn" class="btn btn-primary"
                            @click="togglePush"
                            :disabled="pushButtonDisabled || loading"
                            :class="{'btn-primary': !isPushEnabled, 'btn-danger': isPushEnabled}">
                            @{{ isPushEnabled ? 'Disable' : 'Enable' }} Push Notifications
                        </button>
                    </notifications>
                </div>
            </div>
        </div>
    </div>

</div>

<style>.panel-body .btn {margin-bottom: 10px; margin-right: 10px;}</style>
@endsection
