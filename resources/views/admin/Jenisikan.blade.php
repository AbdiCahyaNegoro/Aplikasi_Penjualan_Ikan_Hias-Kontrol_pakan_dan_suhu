@extends('layouts.beranda.masterberanda')

@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Jenis Ikan</h1>
        </div>
        
        <!-- Grid untuk Menampilkan Data dan Form -->
        <div class="row">
            <!-- Kolom untuk Menampilkan Data -->
            <div class="col-lg-6 mb-4">
                <!-- Daftar Jenis Ikan -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Daftar Jenis Ikan</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTableJenisIkan" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Jenis Ikan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($jenisproduk as $index => $jenis)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $jenis->jenis }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Kolom untuk Menambah Data -->
            <div class="col-lg-6 mb-4">
                <!-- Form Tambah Jenis Ikan -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Tambah Jenis Ikan</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admintambahjenisikan') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="jenis_ikan">Jenis Ikan</label>
                                <input type="text" class="form-control" id="jenis_ikan" name="jenis_ikan" placeholder="Masukkan jenis ikan">
                            </div>
                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
