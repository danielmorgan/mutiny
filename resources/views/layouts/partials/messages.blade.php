@if (! $errors->flash->isEmpty())
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @foreach ($errors->flash->all() as $error)
                    <div class="alert alert-danger">{{ $error }}</div>
                @endforeach
            </div>
        </div>
    </div>
@endif

@if (Session::has('success'))
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="alert alert-success">{{ Session::get('success') }}</div>
            </div>
        </div>
    </div>
@endif

@if (Session::has('info'))
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="alert alert-info">{{ Session::get('info') }}</div>
            </div>
        </div>
    </div>
@endif

@if (Session::has('warning'))
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="alert alert-warning">{{ Session::get('warning') }}</div>
            </div>
        </div>
    </div>
@endif

@if (Session::has('danger'))
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="alert alert-danger">{{ Session::get('danger') }}</div>
            </div>
        </div>
    </div>
@endif
