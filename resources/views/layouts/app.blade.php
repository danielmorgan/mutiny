<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>

    <!-- Progressive Web App Manifest -->
    <link rel="manifest" href="/manifest.json">
</head>
<body>
    @include('layouts.partials.nav')

    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                @include('layouts.partials.actions')
                @include('layouts.partials.errors')
                @include('layouts.partials.messages')
            </div>
        </div>

        <div class="row">
            @if (Auth::check())
                <div class="col-md-3">
                    @include('layouts.partials.move')
                </div>
                <div class="col-md-9">
                    @yield('content')
                </div>
            @else
                <div class="col-md-8 col-md-offset-2">
                    @yield('content')
                </div>
            @endif
        </div>
    </div>

    @include('layouts.partials.footer')
</body>
</html>
