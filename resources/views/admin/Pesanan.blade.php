@extends('layouts.beranda.masterberanda')

@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Daftar Pesanan</h1>
        </div>

        <!-- Notifikasi -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @elseif (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="row">
            <div class="col-lg-12 mb-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Semua Pesanan</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal Pesanan</th>
                                        <th>Nama Pelanggan</th>
                                        <th>Detail Pesanan</th>
                                        <th>Bukti Bayar</th>
                                        <th>Status Pembayaran</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pembayaranMenungguKonfirmasi as $key => $pembayaran)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $pembayaran->tanggal_pembayaran }}</td>
                                            <td>{{ $pembayaran->user_name }}</td>
                                            <td>
                                                <a href="" data-toggle="modal"
                                                    data-target="#detailPesananModal{{ $pembayaran->id_pesanan }}">Lihat
                                                    Detail Pesanan</a>
                                            </td>
                                            <td>
                                                <a href="" data-toggle="modal"
                                                    data-target="#buktiBayarModal{{ $pembayaran->id_pembayaran }}">Lihat
                                                    Bukti Bayar</a>
                                            </td>
                                            <td>{{ $pembayaran->status }}</td>
                                            <td>
                                                <form
                                                    action="{{ route('konfirmasi.pembayaran', $pembayaran->id_pembayaran) }}"
                                                    method="POST" style="display: inline;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success">
                                                        Konfirmasi
                                                    </button>
                                                </form>
                                                <!-- Form Reject -->
                                                <form action="{{ route('reject.pembayaran', $pembayaran->id_pembayaran) }}"
                                                    method="POST" style="display: inline;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger">
                                                        Reject
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @foreach ($pembayaranMenungguKonfirmasi as $pembayaran)
        <!-- Modal Detail Pesanan -->
        <div class="modal fade" id="detailPesananModal{{ $pembayaran->id_pesanan }}" tabindex="-1" role="dialog"
            aria-labelledby="detailPesananModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="detailPesananModalLabel">Detail Pesanan ID:
                            {{ $pembayaran->id_pesanan }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Isi detail pesanan -->
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Nama Produk</th>
                                    <th>Harga Satuan</th>
                                    <th>Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($detailPesanan->where('id_pesanan', $pembayaran->id_pesanan) as $detail)
                                    <tr>
                                        <td>{{ $detail->nama_produk }}</td>
                                        <td>{{ $detail->harga_satuan }}</td>
                                        <td>{{ $detail->qty }}</td>
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


    @foreach ($pembayaranMenungguKonfirmasi as $pembayaran)
        <!-- Modal Bukti Bayar -->
        <div class="modal fade" id="buktiBayarModal{{ $pembayaran->id_pembayaran }}" tabindex="-1" role="dialog"
            aria-labelledby="buktiBayarModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="buktiBayarModalLabel">Bukti Bayar Pembayaran ID:
                            {{ $pembayaran->id_pembayaran }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Isi bukti bayar -->
                        <td><img src="{{ asset($pembayaran->folder . '/' . $pembayaran->buktibayar) }}" width="100px"
                                alt="{{ $pembayaran->buktibayar }}"></td>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
