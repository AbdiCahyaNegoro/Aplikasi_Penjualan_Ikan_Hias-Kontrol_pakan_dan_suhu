@extends('layouts.beranda.masterberanda')
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Produk</h1>

            <!-- Notifikasi Sukses -->
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
        </div>

        <div class="row">
            <!-- Content Column -->
            <div class="col-lg-12 mb-4">
                <!-- Products Table -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Daftar Produk</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama Produk</th>
                                        <th>Harga Satuan</th>
                                        <th>Stok</th>
                                        <th>Jenis Produk</th>
                                        <th>Deskripsi Produk</th>
                                        <th>Foto</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($produk as $item)
                                        <tr>
                                            <td>{{ $item->id_produk }}</td>
                                            <td>{{ $item->nama_produk }}</td>
                                            <td>{{ $item->harga_satuan }}</td>
                                            <td>{{ $item->stok }}</td>
                                            <td>{{ $item->jenis }}</td>
                                            <td>{{ $item->deskripsiproduk }}</td>
                                            <td>
                                                <img src="{{ asset($item->folder . '/' . $item->nama_foto) }}"
                                                    alt="{{ $item->nama_produk }}" style="max-width: 100px; height: auto;">
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
@endsection
