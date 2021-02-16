<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>Inspection Service System</title>

    <!-- Scripts -->
    <link href="/admin/css/styles.css" rel="stylesheet" />
        <link href="/admin/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="/admin/assets/vendor/icofont/icofont.min.css" rel="stylesheet">
        <link href="/admin/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
        <link href="/admin/assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
        <link href="/admin/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
        <link href="/admin/assets/vendor/aos/aos.css" rel="stylesheet">
        <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Lato:100,300,regular,700,900%7COpen+Sans:300%7CIndie+Flower:regular%7COswald:300,regular,700&#038;subset=latin%2Clatin-ext' type='text/css' media='all' />

    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <main class="py-4">
            <div>
                @yield('content')
            </div>    
        </main>
    </div>
</body>
</html>
