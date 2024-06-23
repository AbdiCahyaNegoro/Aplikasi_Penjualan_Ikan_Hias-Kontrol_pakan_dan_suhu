@extends('layouts.beranda.masterberanda')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Tambah Produk</h1>
        </div>

        <!-- Content Row -->
        <div class="row">

            <!-- Content Column -->
            <div class="col-lg-6 mb-4">

                <!-- Form Tambah Produk -->
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <form action="{{ route('admin.simpanproduk') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <!-- Nama Produk -->
                            <div class="form-group">
                                <label for="nama_produk">Nama Produk:</label>
                                <input type="text" class="form-control" id="nama_produk" name="nama_produk" required>
                            </div>

                            <!-- Harga Satuan -->
                            <div class="form-group">
                                <label for="harga_satuan">Harga Satuan:</label>
                                <input type="number" class="form-control" id="harga_satuan" name="harga_satuan" required>
                            </div>

                            <!-- Stok -->
                            <div class="form-group">
                                <label for="stok">Stok:</label>
                                <input type="number" class="form-control" id="stok" name="stok" required>
                            </div>

                            <!-- Jenis Produk -->
                            <div class="form-group">
                                <label for="jenisproduk_id">Jenis Produk:</label>
                                <select class="form-control" id="jenisproduk_id" name="jenisproduk_id" required>
                                    <option value="">Pilih Jenis Produk</option>
                                    @foreach ($jenisproduk as $jenis)
                                        <option value="{{ $jenis->id_jenisproduk }}">{{ $jenis->jenis }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Deskripsi Produk -->
                            <div class="form-group">
                                <label for="deskripsiproduk">Deskripsi Produk:</label>
                                <textarea class="form-control" id="deskripsiproduk" name="deskripsiproduk" required></textarea>
                            </div>

                            <!-- Foto Produk -->
                            <div class="form-group">
                                <label for="nama_foto">Foto Produk:</label>
                                <input type="file" class="form-control-file" id="nama_foto" name="nama_foto" required>
                            </div>

                            <!-- Tombol Submit -->
                            <button type="submit" class="btn btn-primary">Tambah Produk</button>
                        </form>
                    </div>
                </div>

            </div>

        </div>

    </div>
@endsection
