@if (Session::has('errors'))
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @foreach (Session::get('errors') as $error)
                    <div class="alert alert-danger">$error</div>
                @endforeach
            </div>
        </div>
    </div>
@endif
