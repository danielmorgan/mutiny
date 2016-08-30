@extends('layouts.app')

@section('content')
<div class="container">

    {{--Wallet--}}
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default panel-wallet">
                <div class="panel-heading">Wallet</div>

                <div class="panel-body">
                    <div class="balance">
                        <i class="fa fa-credit-card"></i> <strong>Balance:</strong> <span class="balance">{{ Auth::user()->balance }}</span>
                    </div>

                    <div class="money-transfer">
                        <h4>Transfer Money</h4>
                        <form action="/wallet/transfer" method="POST">
                            {{ csrf_field() }}
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-credit-card"></i>
                                </div>
                                <input type="number" min="1" max="{{ Auth::user()->balance }}" class="form-control" id="amount" name="amount" placeholder="Amount">
                                <div class="input-group-addon">
                                    <i class="fa fa-user"></i>
                                </div>
                                <input type="text" class="form-control" id="targetUser" name="targetUser" placeholder="User">
                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-primary">Transfer</button>
                                </div>
                            </div>
                        </form>
                    </div>
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
