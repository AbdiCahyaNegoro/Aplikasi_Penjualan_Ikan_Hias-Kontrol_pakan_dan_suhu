<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error 403 - Forbidden</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- CSS DAN JS -->
    <link href={{ asset('assets/vendor/fontawesome-free/css/all.min.css') }} rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href={{ asset('assets/css/stylebelanja/bootstrap.min.css') }}>
    <link rel="stylesheet" type="text/css" href={{ asset('assets/css/stylebelanja/costumstyle.css') }}>
    <link rel="stylesheet" href={{ asset('assets/css/stylebelanja/responsive.css') }}>
    <link rel="stylesheet" href={{ asset('assets/css/stylebelanja/jquery.mCustomScrollbar.min.css') }}>
    <link rel="stylesheet" type="text/css" href={{ asset('assets/vendor/bootstrap/scss/_alert.scss') }}>
</head>

<body>
    <div class="banner_bg_main">
        <!-- header top section start -->
        <div class="container">
            <div class="header_section_top">
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <img src="{{ asset('assets/img/logobrand.png') }}" alt="Logo Brand" width="200px">
                    </div>
                </div>
            </div>
            <!-- error section start -->
            <div class="error-container">
                <h1>ERROR 403 </h1>
                <p>Anda tidak memiliki akses ke halaman ini.</p>
                <a href="{{ url('/') }}"
                    style=" background-image: linear-gradient(180deg, #224abe 10%, #36b9cc 100%);">Kembali ke Halaman
                    Utama</a>
            </div>
            <!-- error section end -->
        </div>
    </div>
</body>

</html>
