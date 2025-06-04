<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!--<meta name="description" content="" /> -->
    <meta name="author" content="StudyGroup" />
    @stack('meta-seo')
    <title>@yield('title')</title>
    <!-- Favicon-->
    <link rel="icon" type="image/png" href="{{ asset('front/assets/study.png') }}">
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{ asset('front/css/styles.css') }}" rel="stylesheet" />
    <link href="{{ asset('front/css/custom.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    @stack('css')
</head>

<body>
    <!-- Responsive navbar-->
    @include('front.layout.navbar')

    <!-- Page header with logo and tagline-->
    <header class="custom-header py-5 mb-4">
        <div class="container">
            <div class="text-center my-5">
                <h1 class="fw-bolder mb-3">Welcome to Study Group!</h1>
                <p class="lead mb-4">
                    Join our collaborative learning community and boost your academic success together.
                </p>
            </div>

            <div class="search-container">
                <form action="{{ route('search') }}" method="POST">
                    @csrf
                    <div class="input-group search-bar">
                        <input class="form-control" style="color: #063e23" type="text" name="keyword"
                            placeholder="Search Mata Pelajaran..." />
                        <button class="btn btn-search" type="submit">Search</button>
                    </div>
                </form>
            </div>
        </div>
    </header>
    @include('front.layout.side-widget')


    @yield('content')

    <!-- Footer-->
    <footer class="py-5" style="background-color: rgba(12, 75, 45, 0.851);">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; Study Group 2025</p>
        </div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="{{ asset('front/js/scripts.js') }}"></script>
    @stack('js')
</body>

</html>
