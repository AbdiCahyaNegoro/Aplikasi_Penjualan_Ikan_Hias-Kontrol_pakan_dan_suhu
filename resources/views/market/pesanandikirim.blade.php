@extends('layouts.market.masteheaderrmarket')

@section('title', 'Dikirim')

@section('isimarket')
    <div class="fashion_section">
        <div class="container">
            <!-- The sidebar -->
            <div class="sidebar">
                <a href="{{route('tampildatapesananbelumbayar')}}">Belum Bayar</a>
                <a href="{{route('tampildatasudahbayar')}}">Sudah Bayar</a>
                <a class="active" href="{{route('tampildatadikirim')}}">Dikirim</a>
                <a href="{{route('tampildatadibatalkan')}}">Dibatalkan</a>
            </div>

            <!-- Page content -->
            <div class="content">
                <h1>Pesanan Dikirim</h1>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No Pesanan</th>
                                <th>Tanggal Pesanan</th>
                                <th>Total Harga</th>
                                <th>Status</th>
                                <th>Detail Pesanan</th>
                            </tr>
                        </thead>
                    </table>
            </div>
        @endsection
