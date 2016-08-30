@if (Session::has('status'))
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                {{ dump(Session::get('status')) }}
            </div>
        </div>
    </div>
@endif
