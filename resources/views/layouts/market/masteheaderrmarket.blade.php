<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'SELAMAT DATANG::SELAMAT BERBELANJA')</title>
    <!-- CSS DAN JS -->
    <link href={{ asset('assets/vendor/fontawesome-free/css/all.min.css') }} rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href={{ asset('assets/css/stylebelanja/bootstrap.min.css') }}>
    <link rel="stylesheet" type="text/css" href={{ asset('assets/css/stylebelanja/costumstyle.css') }}>
    <link rel="stylesheet" href={{ asset('assets/css/stylebelanja/responsive.css') }}>
    <link rel="stylesheet" href={{ asset('assets/css/stylebelanja/jquery.mCustomScrollbar.min.css') }}>
    <link rel="stylesheet" type="text/css" href={{ asset('assets/vendor/bootstrap/scss/_alert.scss') }}>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
</head>

<body>
    <!-- banner bg main start -->
    <div class="banner_bg_main">
        <!-- header top section start -->
        <div class="container">
            <div class="header_section_top">
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <div class="custom_menu">
                            <ul>
                                <span>
                                    <li><a href="{{ route('index') }}"> <img src={{ asset('assets/img/logobrand.png') }}
                                                width="200px"></li>
                                </span>
                                {{-- Menu Tamu --}}
                                @guest
                                    <li><a href="{{ route('login') }}">LOGIN</a></li>
                                    <li><a href="{{ route('register') }}">REGISTER</a></li>
                                @endguest
                                @auth
                                    @if (Auth::user()->leveluser == 1)
                                        <li><a href="{{ route('beranda') }}">DASHBOARD ADMIN</a></li>
                                    @endif
                                    @if (Auth::user()->leveluser == 2)
                                        <li><a href="{{ route('keranjang') }}">
                                                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                                <span class="padding_10">KERANJANG</span></a>
                                        </li>
                                        <li><a href="{{ route('tampilpesananbelumbayar') }}">
                                                <span class="padding_10">PESANAN</span></a>
                                        </li>
                                    @endif
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown"
                                            role="button" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            {{ strtoupper(Auth::user()->name) }}
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="{{route('Profile')}}">PROFILE</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item"  href="{{ route('logout') }}"
                                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">LOGOUT</a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                style="display: none;">
                                                @csrf
                                            </form>
                                        </div>
                                </ul>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <main>
            @yield('isimarket')
        </main>

        <!-- banner bg main end -->
        <footer>
            <div class="footer_section layout_padding">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <b>Alamat Kami :</b><br>
                            <b>Jl. Penuh Kenangan</b><br>
                            <b>Kota Sukabumi, Negara Indonesia</b><br><br>
                            <b>Telepon : 081223123321</b><br>
                            <b>Email : fishfantasy@gmail.com</b>
                        </div>
                        <div class="col-md-6">
                            <div class="location_text">
                                <iframe
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7921.551651140251!2d106.905092791291!3d-6.917383022328705!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e684829c6dffdd5%3A0xecbbf1784114f3d8!2sPoliteknik%20Sukabumi!5e0!3m2!1sen!2sid!4v1702558957634!5m2!1sen!2sid"
                                    width="100%" height="250" frameborder="0"
                                    style="border:3px; border-radius: 20px;" allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- copyright section start -->
        <div class="copyright_section">
            <div class="container">
                <p class="copyright_text">&copy; <?= date('Y') ?> ABDI CAHYA NEGORO - TEKNIK KOMPUTER POLITEKNIK
                    SUKABUMI</p>
            </div>
        </div>
        </footer>
</body>

</html>
