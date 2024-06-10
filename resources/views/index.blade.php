@extends('layouts.market.masteheaderrmarket')

@section('isimarket')
<div class="fashion_section">
    <div class="container">
        <h1 class="fashion_taital">KOLEKSI</h1>
        <div class="fashion_section_2">
            <div class="row">
                @foreach($produk as $item)
                    <div class="col-sm-4 col-sm-2">
                        <div class="box_main">
                            <h4 class="shirt_text">{{ $item->nama_produk }}</h4>
                            <p class="price_text">Harga <span style="color: #262626;">Rp. {{ $item->harga_satuan }}</span></p>
                            <div class="tshirt_img">
                                <img src="{{ asset($item->folder . '/' . $item->nama_foto) }}" alt="{{ $item->nama_produk }}">
                            </div>
                            <div class="btn_main">
                                <div class="buy_bt"><a href="{{ route('beli-produk')}}" data-toggle="modal" data-target="#modalPembelian">Beli Sekarang</a></div>
                                <div class="seemore_bt"><a href="#">Lihat Detail</a></div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalPembelian" tabindex="-1" role="dialog" aria-labelledby="modalPembelianLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalPembelianLabel">Pembelian Produk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Konten modal di sini -->
                Silakan pilih opsi pembayaran dan selesaikan pembelian Anda.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <!-- Tombol untuk menyelesaikan pembelian -->
                <a href="" class="btn btn-primary">Selesaikan Pembelian</a>
            </div>
        </div>
    </div>
</div>

@endsection