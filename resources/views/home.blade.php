@extends('layouts.app')

@section('content')
<div class="container">

    {{--Wallet--}}
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Wallet</div>

                <div class="panel-body">
                    <i class="fa fa-credit-card"></i> <strong>Balance:</strong> <span class="balance">{{ Auth::user()->balance }}</span>

                    <money-transfer></money-transfer>
                </div>
            </div>
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
