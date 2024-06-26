@extends('layouts.beranda.masterberanda')

@section('title', 'Pengiriman Belum Dikirim')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Pengiriman Belum Dikirim</h1>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Pengiriman Belum Kirim</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal Pengiriman</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pengiriman as $key => $kirim)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $kirim->tanggal_pengiriman }}</td>
                                    <td>{{ $kirim->status }}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#detailPesanan{{ $kirim->id_pengiriman }}">
                                            Detail Pesanan
                                        </button>
                                        <a href="{{ route('admin.kirimForm', $kirim->id_pengiriman) }}"
                                            class="btn btn-success">Kirim</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @foreach ($pengiriman as $kirim)
        <!-- Modal Detail Pesanan -->
        <div class="modal fade" id="detailPesanan{{ $kirim->id_pengiriman }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail Pesanan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Nama Produk</th>
                                    <th>Jumlah</th>
                                    <th>Harga Satuan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($detailPesanan->where('id_pesanan', $kirim->id_pesanan) as $detail)
                                    <tr>
                                        <td>{{ $detail->nama_produk }}</td>
                                        <td>{{ $detail->qty }}</td>
                                        <td>{{ $detail->harga_satuan }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection