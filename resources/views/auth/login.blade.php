
    <!doctype html>
    <html lang="en">
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width,initial-scale=1">
            <meta name="author" content="Ghalmas Shanditya Putra Agung">
            <title>
                Masuk
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
                html,
                body {
                height: 100%;
                }

                body {
                display: flex;
                align-items: center;
                padding-top: 40px;
                padding-bottom: 40px;
                background-color: #f5f5f5;
                }

                .form-signin {
                width: 100%;
                max-width: 330px;
                padding: 15px;
                margin: auto;
                }

                .form-signin .checkbox {
                font-weight: 400;
                }

                .form-signin .form-floating:focus-within {
                z-index: 2;
                }

                .form-signin input[type="email"] {
                margin-bottom: -1px;
                border-bottom-right-radius: 0;
                border-bottom-left-radius: 0;
                }

                .form-signin input[type="password"] {
                margin-bottom: 10px;
                border-top-left-radius: 0;
                border-top-right-radius: 0;
                }
            </style>

        </head>
        <body class="text-center" style="background: #E4F0C5;">
            <main class="form-signin">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <a href="/"><img class="img" src="{{asset('assets/dist/img/icons')}}/majoo.png" alt="" width="125" height="125"></a>
                    <h1 class="h3 mb-3 fw-normal">Silahkan masuk</h1>
                    @if (session()->has('gagal'))
                        <div class="alert alert-danger" role="alert">
                            {{ session()->get('gagal') }}
                        </div>
                    @elseif(session()->has('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session()->get('success') }}
                        </div>
                    @endif
                    <div class="form-floating">
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="floatingInput" placeholder="you@example.com" value="{{ old('email') }}">
                        <label for="floatingInput">Email</label>
                    </div>
                    <div class="form-floating">
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="floatingPassword" placeholder="Password">
                        <label for="floatingPassword">Password</label>
                    </div>
                    <button class="w-100 btn btn-lg text-white" style="background: #07C53C" type="submit">Masuk</button>
                    <p class="mt-2 text-muted">Belum punya akun ? <a href="{{ route("register") }}" style="color: #07C53C;text-decoration:none" >Daftar</a></p>
                    <p class="mb-3 text-muted">2019 &copy; PT Majoo Teknologi Indonesia</p>
                </form>
            </main>
        </body>
    </html>
