@extends('layouts.market.masteheaderrmarket')

@section('title', 'Pesanan')

@section('isimarket')
    <div class="fashion_section">
        <div class="container">
            <!-- The sidebar -->
            <div class="sidebar">
                <a class="active" href="{{ route('tampilpesananbelumbayar') }}">Belum Bayar</a>
                <a href="{{ route('tampildatasudahbayar') }}">Sudah Bayar</a>
                <a href="{{ route('tampildatadikirim') }}">Dikirim</a>
                <a href="{{ route('tampildatadibatalkan') }}">Dibatalkan</a>
            </div>

            <!-- Page content -->
            <div class="content">
                <h1>Belum Bayar</h1>
                @if ($pesanan->isEmpty())
                    <p>Tidak ada pesanan yang tersedia.</p>
                @else
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No Pesanan</th>
                                <th>Tanggal Pesanan</th>
                                <th>Total Harga</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pesanan as $order)
                                <tr>
                                    <td>{{ $order->id_pesanan }}</td>
                                    <td>{{ $order->tanggalpesanan }}</td>
                                    <td>Rp. {{ number_format($order->totalpesanan, 0, ',', '.') }}</td>
                                    <td>{{ $order->status }}</td>
                                    <td>
                                        <button type="button" class="btn btn-info" data-toggle="modal"
                                            data-target="#detailPesanan{{ $order->id_pesanan }}">
                                            Detail
                                        </button>
                                        <button type="button" class="btn btn-danger"
                                            style="background-image: linear-gradient(180deg, #224abe 10%, #36b9cc 100%);"
                                            data-toggle="modal" data-target="#bayarpesanan{{ $order->id_pesanan }}">
                                            Bayar
                                        </button>
                                        <form action="{{ route('batalkanpesanan', $order->id_pesanan) }}" method="POST" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-danger">Batalkan</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>

        @foreach ($pesanan as $order)
            <!-- Modal Detail Pesanan -->
            <div class="modal fade" id="detailPesanan{{ $order->id_pesanan }}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Detail Pesanan {{ $order->id_pesanan }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Foto</th>
                                        <th>Nama Produk</th>
                                        <th>Quantity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($detailPesanan->where('id_pesanan', $order->id_pesanan) as $detail)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td><img src="{{ asset($detail->folder . '/' . $detail->nama_foto) }}"
                                                    width="100px" alt="{{ $detail->nama_produk }}"></td>
                                            <td>{{ $detail->nama_produk }}</td>
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

            <!-- Modal Bayar Pesanan -->
            <div class="modal fade" id="bayarpesanan{{ $order->id_pesanan }}" tabindex="-1" role="dialog"
                aria-labelledby="bayarModalLabel{{ $order->id_pesanan }}" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="bayarModalLabel{{ $order->id_pesanan }}">Bayar Pesanan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('bayarpesanan', $order->id_pesanan) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>No Rekening:</label>
                                    <p style="font-size: 16px; font-weight: bold; color: #224abe;">11223344</p>
                                    <label>Nama:</label>
                                    <p style="font-size: 16px; font-weight: bold; color: #224abe;">Abdi Cahya Negoro</p>
                                    <label>Bank:</label>
                                    <p style="font-size: 16px; font-weight: bold; color: #224abe;">Bank Negara</p>
                                </div>
                                <div class="form-group">
                                    <label for="buktibayar">Upload Bukti Bayar</label>
                                    <input type="file" class="form-control" id="buktibayar" name="buktibayar" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Kirim</button>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
