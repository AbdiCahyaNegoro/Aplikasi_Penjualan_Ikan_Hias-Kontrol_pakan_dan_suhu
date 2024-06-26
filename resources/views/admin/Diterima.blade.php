@extends('layouts.beranda.masterberanda')

@section('title', 'Pengiriman Diterima')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Pengiriman Diterima</h1>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Pengiriman Diterima</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal Pengiriman</th>
                                <th>Id Pesanan</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pengiriman as $key => $kirim)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $kirim->tanggal_pengiriman }}</td>
                                    <td>{{ $kirim->id_pesanan }}</td>
                                    <td>{{ $kirim->status }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
