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
                @include('layouts.partials.errors')
                @include('layouts.partials.messages')
                @include('layouts.partials.actions')
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                @include('layouts.partials.sidebar')
            </div>
            <div class="col-md-9">
                @yield('content')
            </div>
        </div>
    </div>

    @include('layouts.partials.footer')
</body>
</html>
