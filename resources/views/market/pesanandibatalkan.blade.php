@extends('layouts.market.masteheaderrmarket')

@section('title', 'Pesanan Dibatalkan')

@section('isimarket')
    <div class="fashion_section">
        <div class="container">
            <!-- The sidebar -->
            <div class="sidebar">
                <a href="{{ route('tampilpesananbelumbayar') }}">Belum Bayar</a>
                <a href="{{ route('tampildatasudahbayar') }}">Sudah Bayar</a>
                <a href="{{ route('tampildatadikirim') }}">Dikirim</a>
                <a class="active" href="{{ route('tampildatadibatalkan') }}">Dibatalkan</a>
            </div>

            <!-- Page content -->
            <div class="content">
                <h1>Pesanan Dibatalkan</h1>
                <table class="table">
                    <thead>
                        <tr>
                            <th>No Pesanan</th>
                            <th>Tanggal Pesanan</th>
                            <th>Total Harga</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dibatalkan as $order)
                            <tr>
                                <td>{{ $order->id_pesanan }}</td>
                                <td>{{ $order->tanggalpesanan }}</td>
                                <td>Rp. {{ number_format($order->totalpesanan, 0, ',', '.') }}</td>
                                <td>{{ $order->status }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
