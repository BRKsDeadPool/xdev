<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="@yield('description')">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')- {{ config('app.name', 'XFind') }}</title>

    <!-- Disable tap highlight on IE -->
    <meta name="msapplication-tap-highlight" content="no">

    <!-- Add to homescreen for Chrome on Android -->
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="application-name" content="Web Starter Kit">
    <link rel="icon" sizes="192x192" href="images/touch/logo_192x192.png">

    <!-- Add to homescreen for Safari on iOS -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Web Starter Kit">
    <link rel="apple-touch-icon" href="images/touch/logo_192x192.png">

    <!-- Tile icon for Win8 (144x144 + tile color) -->
    <meta name="msapplication-TileImage" content="images/touch/logo_144x144.png">
    <meta name="msapplication-TileColor" content="#800000">

    <!-- Color the status bar on mobile devices -->
    <meta name="theme-color" content="#800000">

    <!-- Styles -->

    <link href="/css/app.css" rel="stylesheet">
        <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body class="blue-grey lighten-3">


<div id="app">
@yield('content')
</div>

<!-- Scripts -->
<script src="/js/app.js"></script>
<script src="/js/progress.js"></script>
@include('errors.common')
<script>
    NProgress.configure({
       easing: 'ease-out', speed: 3000
    });
    NProgress.start();
    NProgress.done();
</script>
@yield('script')

</body>
</html>
