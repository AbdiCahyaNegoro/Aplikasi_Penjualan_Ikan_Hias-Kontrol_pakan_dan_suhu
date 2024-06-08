<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SELAMAT DATANG::SELAMAT BERBELANJA</title>
    <!-- CSS DAN JS -->
    <link rel="stylesheet" type="text/css" href="assets/css/stylebelanja/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/stylebelanja/costumstyle.css">
    <link rel="stylesheet" href="assets/css/stylebelanja/responsive.css">
    <link rel="stylesheet" href="assets/css/stylebelanja/jquery.mCustomScrollbar.min.css">

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
                                        <li><a href="#">
                                                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                                <span class="padding_10">Keranjang</span></a>
                                        </li>
                                    @endif
                                <li>
                                    {{ strtoupper(Auth::user()->name) }}
                                </li>
                                <li><a href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">LOGOUT</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="logo_section">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="logo"><a href="{{ url('/') }}"><img src="assets/img/logobrand.png"
                                    width="300px"></a></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- logo section end -->
        <!-- header section start -->
        <div class="header_section">
            <div class="container">
                <div class="containt_main">
                    <div class="main">
                        <!-- Another variation with a button -->
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Cari Ikan">
                            <div class="input-group-append">
                                <button class="btn btn-secondary" type="button"
                                    style="background-color: #683003; border-color:#683003">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- header section end -->
    <main>
        @yield('isimarket')
    </main>
    <!-- banner bg main end -->
    <footer>
        <div class="footer_section layout_padding">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="location_text">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7921.551651140251!2d106.905092791291!3d-6.917383022328705!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e684829c6dffdd5%3A0xecbbf1784114f3d8!2sPoliteknik%20Sukabumi!5e0!3m2!1sen!2sid!4v1702558957634!5m2!1sen!2sid"
                                width="50%" height="250" frameborder="0" style="border:3px; border-radius: 20px;" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- footer section end -->
        <!-- copyright section start -->
        <div class="copyright_section">
            <div class="container">
                <p class="copyright_text">&copy; <?= date('Y') ?> ABDI CAHYA NEGORO TEKNIK KOMPUTER POLITEKNIK SUKABUMI</p>
            </div>
        </div>
    </footer>
</body>

</html>
