
    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <meta name="author" content="Ghalmas Shanditya Putra Agung">
        <title>
            @yield('title')
        </title>
        <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/dist/img/icons')}}/favicon.png">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" crossorigin="anonymous">
        {{-- <link href="{{asset('assets/dist/bootstrap')}}/css/bootstrap.min.css" rel="stylesheet"  crossorigin="anonymous"> --}}
        <!--======= GOOGLE FONTS ========-->
        <link rel="preconnect" href="https://fonts.gstatic.com/">
        <link href="https://fonts.googleapis.com/css?family=Quicksand:500,600,700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Muli:400,600&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@200;400;500;600&display=swap" rel="stylesheet">

        <style>
            .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
            }

            @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
            }
        </style>

    </head>
    <body>

    @include('users.layouts.header')

    <main style="padding-top: 5rem; min-height: 100vh">
        <div class="container flex">
            @yield('content')
        </div>
    </main>

    @include('users.layouts.footer')
    @include('sweetalert::alert')

    {{-- <script src="{{ asset("assets/dist/bootstrap") }}/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script> --}}
    <script src="{{ asset("assets/dist/bootstrap") }}/js/form-validation.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" crossorigin="anonymous"></script>
    </body>
</html>

