<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Laravel'))</title>

    <!-- Scripts
    <script src="{{ asset('js/app.js') }}" defer></script>-->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Font awesome 5 -->
    <link href="{{asset('fonts/fontawesome/css/fontawesome-all.min.css')}}" type="text/css" rel="stylesheet">
    @livewireStyles



    <style>
        #intro {
            background-image: url("{{asset('images/bg.png')}}");
            background-size: cover;
            background-position: center center;
            background-repeat: no-repeat;
            height: 100vh;
            width: 100%;
        }

        /* Height for devices larger than 576px */
        @media (min-width: 992px) {
            #intro {
         /*       margin-top: -58.59px;*/
            }
        }

    </style>



</head>
<body>

    <div id="intro" class="container-fluid py-4 shadow-lg">
            @yield('content')









    </div>
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
     @livewireScripts
@yield('scripts')
</body>
</html>
