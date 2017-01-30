<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="user-id" content="{{ Auth::user()->id }}">

    <title>{{ config('app.name') }} - czat inny niż wszystkie</title>

    <!-- Style -->
    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/all.css" rel="stylesheet">

    <!-- Skrypty wstępne -->
    <script>window.Laravel = <?php echo json_encode(['csrfToken' => csrf_token()]); ?></script>
    <script src="{{ config('app.url') }}:3000/socket.io/socket.io.js"></script>
    <script src="/js/app.js"></script>
    <script src="/js/all.js"></script>
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="navbar-header">
                {{-- Nazwa strony --}}
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name') }}
                </a>
                {{-- Przycik hamburgera --}}
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Filtry</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>

            {{-- Wyszukiwarka --}}
            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                @include('partials.filters')
            </div>
        </nav>

        {{-- Sidebar --}}
        <div class="side-nav">
            @include('partials.sidebar')
        </div>

        {{-- Treść --}}
        <div id="content">
            @yield('content')
        </div>
    </div>

    {{-- Skrypty końcowe --}}
    <script src="/js/chat.js"></script>
</body>
</html>
