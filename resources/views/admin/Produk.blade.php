@extends('layouts.beranda.masterberanda')
@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Produk</h1>
        </div>
        <div class="row">
            <div class="col-lg-12 mb-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Daftar Produk</h6>
                    </div>
                    <div class="card-body">
                        <!-- Notifikasi Error -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
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
                                        <th></th>
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
                                            <td>
                                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                                    data-target="#ubahProdukModal{{ $item->id_produk }}">
                                                    Ubah
                                                </button>
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

    <!-- Modal Ubah Produk -->
    @foreach ($produk as $item)
        <div class="modal fade" id="ubahProdukModal{{ $item->id_produk }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ubah Produk</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin.simpanubahproduk', ['id' => $item->id_produk]) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="nama_produk{{ $item->id_produk }}">Nama Produk:</label>
                                <input type="text" class="form-control" id="nama_produk{{ $item->id_produk }}"
                                    name="nama_produk" value="{{ $item->nama_produk }}" required>
                            </div>
                            <div class="form-group">
                                <label for="harga_satuan{{ $item->id_produk }}">Harga Satuan:</label>
                                <input type="number" class="form-control" id="harga_satuan{{ $item->id_produk }}"
                                    name="harga_satuan" value="{{ $item->harga_satuan }}" required>
                            </div>
                            <div class="form-group">
                                <label for="stok{{ $item->id_produk }}">Stok:</label>
                                <input type="number" class="form-control" id="stok{{ $item->id_produk }}" name="stok"
                                    value="{{ $item->stok }}" required>
                            </div>
                            <div class="form-group">
                                <label for="deskripsiproduk{{ $item->id_produk }}">Deskripsi Produk:</label>
                                <textarea class="form-control" id="deskripsiproduk{{ $item->id_produk }}" name="deskripsiproduk" required>{{ $item->deskripsiproduk }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="foto_produk{{ $item->id_produk }}">Foto Produk:</label>
                                <input type="file" class="form-control-file" id="foto_produk{{ $item->id_produk }}"
                                    name="foto_produk">
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
