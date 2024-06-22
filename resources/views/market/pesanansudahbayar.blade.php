@extends('layouts.market.masteheaderrmarket')

@section('title', 'Sudah Bayar')

@section('isimarket')
    <div class="fashion_section">
        <div class="container">
            <!-- The sidebar -->
            <div class="sidebar">
                <a href="{{ route('tampilpesananbelumbayar') }}">Belum Bayar</a>
                <a class="active" href="{{ route('tampildatasudahbayar') }}">Sudah Bayar</a>
                <a href="{{ route('tampildatadikirim') }}">Dikirim</a>
                <a href="{{ route('tampildatadibatalkan') }}">Dibatalkan</a>
            </div>

            <!-- Page content -->
            <div class="content">
                <h1>Sudah Bayar</h1>
                @if ($pembayaran->isEmpty())
                    <p>Tidak ada pesanan yang sudah dibayar.</p>
                @else
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Tanggal Pembayaran</th>
                                <th>Status</th>
                                <th>Bukti Bayar</th>
                                <th></th> <!-- Kolom baru untuk tombol "Lihat Pesanan" -->
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pembayaran as $bayar)
                                <tr>
                                    <td>{{ $bayar->tanggal_pembayaran }}</td>
                                    <td>{{ $bayar->status }}</td>
                                    <td>
                                        <a href="{{ asset('storage/' . $bayar->folder . '/' . $bayar->buktibayar) }}" target="_blank">
                                            Lihat Bukti
                                        </a>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#detailPesanan{{ $bayar->id_pembayaran }}">
                                            Lihat Pesanan
                                        </button>
                                    </td>
                                </tr>
                                <!-- Modal Detail Pesanan -->
                                <div class="modal fade" id="detailPesanan{{ $bayar->id_pembayaran }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Detail Pesanan {{ $bayar->id_pembayaran }}</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Tambahkan rincian pesanan di sini -->
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
@endsection