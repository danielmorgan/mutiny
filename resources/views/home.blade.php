@extends('layouts.app')

@section('content')
<div class="container">

    {{--Map--}}
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Map</div>

                <div class="panel-body">
                    <ul>
                        @foreach ($locations as $location)
                            <li>
                                Location:
                                {{ dump($location->toArray()) }}
                                Locatable (Ship, User etc.):
                                {{ dump($location->locatable->toArray()) }}
                                <hr>
                            </li>
                        @endforeach
                    </ul>
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
