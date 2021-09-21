
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
        <link href="{{asset('assets/dist/bootstrap')}}/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

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

    <script src="{{ asset("assets/dist/bootstrap") }}/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    <script src="{{ asset("assets/dist/bootstrap") }}/js/form-validation.js"></script>
    </body>
</html>

