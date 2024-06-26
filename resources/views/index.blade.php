@extends('layouts.market.masteheaderrmarket')

@section('isimarket')
    <div class="logo_section">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="logo"><a href="{{ url('/index') }}"><img src="{{ asset('assets/img/logobrand.png') }}" width="300px"></a>
                    </div>
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
                                style=" background-image: linear-gradient(180deg, #224abe 10%, #36b9cc 100%);">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- header section end -->

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="fashion_section">
        <div class="container">
            <h1 class="fashion_taital">KOLEKSI</h1>
            <div class="fashion_section_2">
                <div class="row">
                    @foreach ($produk as $item)
                        <div class="col-sm-4">
                            <div class="box_main">
                                <h4 class="shirt_text">{{ $item->nama_produk }}</h4>
                                <div class="produk_img">
                                    <img src="{{ asset($item->folder . '/' . $item->nama_foto) }}"
                                        alt="{{ $item->nama_produk }}">
                                </div><br>
                                <p class="price_text">Harga <span style="color: #262626;">Rp.
                                        {{ number_format($item->harga_satuan, 0, ',', '.') }}     |   Stok {{($item->stok) }} </span></p><br>
                                <div class="btn_main">
                                    @auth
                                        <div class="buy_bt"><a
                                                href="{{ route('tambahkankeranjang2', $item->id_produk) }}">Tambahkan<i
                                                    class="fa fa-cart-arrow-down"></i></a>
                                        </div>
                                        <div class="buy_bt"><a href="{{ route('detailproduk', $item->id_produk) }}">Lihat
                                                Detail</a></div>
                                    @else
                                        <div class="buy_bt"><a href="{{ route('login') }}">Tambahkan<i
                                                    class="fa fa-cart-arrow-down"></i></a></div>
                                        <div class="buy_bt"><a href="{{ route('login') }}">Lihat Detail</a></div>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection