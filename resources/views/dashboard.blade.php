@extends('layouts.app')

@section('content')
    {{--Push Notifications--}}
    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <h2>Notifications</h2>
                    <notifications inline-template>
                        <button type="btn" class="btn btn-success btn-send" :disabled="loading" @click="sendNotification">
                            Send Test Notification
                        </button>

                        <br>

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

    <style>.panel-body .btn {margin-bottom: 10px; margin-right: 10px;}</style>
@endsection
