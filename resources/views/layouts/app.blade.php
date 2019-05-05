<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'MyIUTMovies') }}</title>
        <link rel="shortcut icon" href="data/img/logo.png">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="data/fonts/all.min.css">
        <link rel="stylesheet" href="data/css/owl.carousel.min.css">
        <link rel="stylesheet" href="data/css/owl.theme.default.min.css">
        <link rel="stylesheet" href="data/css/style.css">
        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <!-- Popper JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    </head>
    <body>
        @include('inc.navbar')
        <div class="container">
            <div class="mt-3">
                @include('inc.messages')
                @yield('content')
            {{-- <h1>!{{Cache::get('key')}}</h1> --}}
            </div>
        </div>
        <footer class="footer bg-dark p-4">
        <h5 class="my-2 text-center" style="color:white">© Copyright 2019 Tashkent, Inha University</h5>
    </footer>
    </body>
    <script src="data/js/index.js"></script>
</html>
