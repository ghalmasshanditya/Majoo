<header class="p-3 mb-3 border-bottom fixed-top" style="background: #E4F0C5;">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-dark text-decoration-none">
                <img src="{{asset('assets/dist/img/icons')}}/majoo_landscape.png" class="bi me-2" width="125" height="45" role="img" alt="...">
            </a>

            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
            <li><a href="#" class="navbar-brand px-2 link-dark">Majoo Teknologi Indonesia</a></li>
            </ul>


            <div class="dropdown text-end">
                @if (Auth::user())
                <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="https://github.com/mdo.png" alt="mdo" width="40" height="40" class="rounded-circle">
                </a>
                <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">
                    <li><a class="dropdown-item" href="#">Sign out</a></li>
                </ul>
                @else
                    <a href="{{ route('login') }}"><button class="btn text-white btn-default" style="background: #07C53C;" >MASUK</button></a>
                    <a href="{{ route('register') }}"><button class="btn text-white btn-default" style="background: #4289C7" >DAFTAR</button></a>
                @endif

            </div>
        </div>
    </div>
</header>
