@extends('layouts.market.masteheaderrmarket')

@section('title', 'Pesanan')

@section('isimarket')
    <div class="fashion_section">
        <div class="container">
            <br><br>
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="#">Toko Anda</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="">Belum Bayar
                                <span class="badge badge-primary">
                                    <!-- Logika untuk menampilkan jumlah item -->
                                
                                </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="">Status Kirim
                                <span class="badge badge-success">
                                    <!-- Logika untuk menampilkan jumlah item -->
                            
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
            
        </div>
    </div>
@endsection
