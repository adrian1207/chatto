<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/all.css" rel="stylesheet">

    <!-- Scripts -->
    <script src="/js/login.js"></script>
    <script>window.Laravel = <?php echo json_encode(['csrfToken' => csrf_token()]); ?></script>
</head>
<body class="login">
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="navbar-header">
            {{-- Nazwa strony --}}
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name') }}
            </a>
        </div>
    </nav>

    {{-- Treść --}}
    <div class="vertical">
        <div class="content">
            @yield('content')
        </div>
    </div>
</body>
</html>
