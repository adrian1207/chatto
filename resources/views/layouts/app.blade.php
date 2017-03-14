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
                {{-- Przycik filtrów --}}
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#filter-navbar-collapse">
                    <i class="fa fa-filter fa-fw" aria-hidden="true"></i>
                </button>

                {{-- Przycik sidebaru --}}
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#profile-navbar-collapse">
                    <i class="fa fa-user fa-fw" aria-hidden="true"></i>
                </button>
            </div>

            {{-- Filtry --}}
            <div class="collapse navbar-collapse" id="filter-navbar-collapse">
                @include('partials.filters')
            </div>
        </nav>

        {{-- Sidebar --}}
        <div class="collapse navbar-collapse side-nav" style="overflow-y: auto !important" id="profile-navbar-collapse">
            @include('partials.sidebar')
        </div>

        {{-- Treść --}}
        <div id="content">
            @yield('content')
        </div>
    </div>

    {{-- Skrypty końcowe --}}
    <script src="/js/chat.js"></script>
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-91443844-1', 'auto');
        ga('send', 'pageview');

    </script>
</body>
</html>
