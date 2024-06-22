@extends('layouts.beranda.masterberanda')
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Produk</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
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
                                        <th>Nama Foto</th>
                                        <th>Folder</th>
                                        <th>Dibuat Pada</th>
                                        <th>Diperbarui Pada</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($produks as $produk)
                                        <tr>
                                            <td>{{ $produk->id_produk }}</td>
                                            <td>{{ $produk->nama_produk }}</td>
                                            <td>{{ $produk->harga_satuan }}</td>
                                            <td>{{ $produk->stok }}</td>
                                            <td>{{ $produk->jenisproduk_id }}</td>
                                            <td>{{ $produk->deskripsiproduk }}</td>
                                            <td>{{ $produk->nama_foto }}</td>
                                            <td>{{ $produk->folder }}</td>
                                            <td>{{ $produk->created_at }}</td>
                                            <td>{{ $produk->updated_at }}</td>
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
