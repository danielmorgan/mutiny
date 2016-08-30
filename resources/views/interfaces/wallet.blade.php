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

                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-credit-card"></i></div>
                                <input id="amount" type="text" max="{{ Auth::user()->balance }}" class="form-control" name="amount" placeholder="Amount" value="{{ old('amount') }}" required>
                            </div>

                            @if ($errors->has('amount'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('amount') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group{{ $errors->has('targetUser') ? ' has-error' : '' }}">
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                <input type="text" id="targetUser" class="form-control" name="targetUser" placeholder="User" value="{{ old('targetUser') }}" required>
                            </div>

                            @if ($errors->has('targetUser'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('targetUser') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-2">
                        <button type="submit" class="btn btn-primary">Transfer</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
