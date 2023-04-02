<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? "Media-Meet" }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        *{
            padding: 0;
            margin: 0;
        }
        .sidebar-ul li{
            list-style-type: none;
            
        }
        .sidebar-ul li a{
            padding: 10px 10px 10px 30px;
            
        }
        .sidebar-ul li:hover{
            background: rgb(172, 172, 172);
            color: white;
        }
        a{
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div id="app">
        @include('include.header')
        <main class="py-4">
            <div class="row h-100 m-0 p-0">
                @if(Auth::user())
                <div class="col col-md-2 p-0">
                    @include('include.sidebar')
                </div>
                @endif
                <div @if(Auth::user()) class="col col-md-10" @else class="col-12" @endif >
                    @yield('content')
                </div>
            </div>
        </main>
        @include('include.footer')
    </div>
</body>


</html>
