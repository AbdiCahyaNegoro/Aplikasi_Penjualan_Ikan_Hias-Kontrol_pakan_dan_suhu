@extends('layouts.market.masteheaderrmarket')
@section('title', 'Detail Produk')

@section('isimarket')
    <div class="fashion_section">
        <div class="container">
            <br><br>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <h1>Detail Produk</h1>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ $produk->nama_produk }}</h4>
                        </div>
                        <div class="card-body">
                            <img src="{{ asset($produk->folder . '/' . $produk->nama_foto) }}" class="img-fluid"
                                alt="{{ $produk->nama_produk }}">

                            <p class="mt-3">Deskripsi Ikan: <span
                                    style="font-style: italic">{{ $produk->deskripsiproduk }}</span></p>
                            <p class="mt-3">Jenis Ikan: <span style="font-style: italic">{{ $produk->jenis }}</span></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Harga dan Stok</h4>
                        </div>
                        <div class="card-body">
                            <p><strong>Harga:</strong> Rp. {{ number_format($produk->harga_satuan, 0, ',', '.') }}</p>
                            <p><strong>Stok:</strong> {{ $produk->stok }}</p>
                        </div>
                    </div>
                    <div class="card mt-4">
                        <div class="card-header">
                            <h4>Pesan Produk</h4>
                        </div>
                        <div class="card-body">
                            <!-- Form untuk pesan produk -->
                            <form action="{{ route('tambahkankeranjang1')}}" method="POST">
                                @csrf
                                <input type="hidden" name="id_produk" value="{{ $produk->id_produk}}">
                                <div class="form-group">
                                    <label for="jumlah">Jumlah:</label>
                                    <input type="number" class="form-control" id="jumlah" name="jumlah" min="1"
                                        max="{{ $produk->stok }}" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Masuk Keranjang</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
