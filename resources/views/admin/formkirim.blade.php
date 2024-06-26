@extends('layouts.beranda.masterberanda')

@section('title', 'Kirim Pengiriman')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Kirim Pengiriman</h1>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Form Pengiriman</h6>
                <!-- Tombol Cetak -->
                <button type="button" class="btn btn-success mt-3" onclick="printSection('print-section')">Cetak</button>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <!-- Informasi Pemesan -->
                <div class="mb-4" id="print-section">
                    <img src="{{ asset('assets/img/logobrand.png') }}" alt="logobrand" style="max-width: 100px;">
                    <h5 class="font-weight-bold">Informasi Pemesan</h5>
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td style="width: 30%;"><strong>Nama Pemesan:</strong></td>
                                <td>{{ $pemesan->name }}</td>
                            </tr>
                            <tr>
                                <td><strong>Email:</strong></td>
                                <td>{{ $pemesan->email }}</td>
                            </tr>
                            <tr>
                                <td><strong>Alamat:</strong></td>
                                <td>{{ $pemesan->alamat }}</td>
                            </tr>
                            <tr>
                                <td><strong>Jenis Kelamin:</strong></td>
                                <td>{{ $pemesan->jeniskelamin }}</td>
                            </tr>
                            <tr>
                                <td><strong>No Hp:</strong></td>
                                <td>{{ $pemesan->no_hp }}</td>
                            </tr>
                        </tbody>
                    </table>

                    <h5 class="font-weight-bold">Detail Pesanan</h5>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nama Produk</th>
                                <th>Jumlah</th>
                                <th>Harga Satuan</th>
                                <th>Total Pesanan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($detailPesanan as $detail)
                                <tr>
                                    <td>{{ $detail->nama_produk }}</td>
                                    <td>{{ $detail->qty }}</td>
                                    <td>{{ $detail->harga_satuan }}</td>
                                    <td>{{ $detail->qty * $detail->harga_satuan }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <hr>

                <!-- Form Pengiriman -->
                <form action="{{ route('admin.kirimpesanan', $pengiriman->id_pengiriman) }}" method="POST"
                    enctype="multipart/form-data" id="kirim-form">
                    @csrf
                    <div class="form-group">
                        <label for="tanggal_pengiriman">Tanggal Pengiriman</label>
                        <input type="date" class="form-control" id="tanggal_pengiriman" name="tanggal_pengiriman"
                            value="{{ old('tanggal_pengiriman') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="foto_resi">Foto Resi</label>
                        <input type="file" class="form-control-file" id="foto_resi" name="foto_resi" required>
                    </div>
                    <button type="submit" class="btn btn-primary" id="kirim-button" disabled>Kirim Pengiriman</button>
                </form>
            </div>
        </div>
    </div>

    <style>
        @media print {
            body * {
                visibility: hidden;
            }

            #print-section,
            #print-section * {
                visibility: visible;
            }

            #print-section {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
            }
        }
    </style>

    <script>
        function printSection(sectionId) {
            var printContents = document.getElementById(sectionId).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;

            // Aktifkan tombol kirim setelah mencetak
            document.getElementById('kirim-button').disabled = false;
        }

        // Tambahkan event listener untuk memastikan tombol kirim hanya aktif setelah mencetak
        document.getElementById('kirim-button').addEventListener('click', function(event) {
            if (this.disabled) {
                event.preventDefault();
                alert('Silakan cetak informasi terlebih dahulu sebelum mengirim pengiriman.');
            }
        });
    </script>
@endsection