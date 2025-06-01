<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>studyGroup</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="{{ asset('front/css/custom.css') }}" rel="stylesheet" />
    @stack('css')

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body class="d-flex flex-column min-vh-100">
    <div id="app" class="flex-grow-1">
        @include('front.layout.navbar')

        <main class="py-4 flex-grow-1">
            @yield('content')
        </main>
    </div>

    <footer class="py-5" style="background-color: rgba(12, 75, 45, 0.851);">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; Study Group 2025</p>
        </div>
    </footer>

    <script src="{{ asset('front/js/scripts.js') }}"></script>
    @stack('js')
</body>

</html>
