@extends('layouts.market.masteheaderrmarket')

@section('title', 'Pesanan Dikirim')

@section('isimarket')
    <div class="fashion_section">
        <div class="container">
            <!-- The sidebar -->
            <div class="sidebar">
                <a href="{{ route('tampilpesananbelumbayar') }}">Belum Bayar</a>
                <a href="{{ route('tampildatasudahbayar') }}">Sudah Bayar</a>
                <a class="active" href="{{ route('tampildatadikirim') }}">Dikirim</a>
                <a href="{{ route('tampildatadibatalkan') }}">Dibatalkan</a>
            </div>

            <!-- Page content -->
            <div class="content">
                <h1>Pesanan Dikirim</h1>
                @if ($pengirimanList->isEmpty())
                    <p>Tidak ada pesanan yang sedang dikirim.</p>
                @else
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No Pesanan</th>
                                <th>Tanggal Pengiriman</th>
                                <th>Status</th>
                                <th>Detail Pesanan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pengirimanList as $no => $kirim )
                                <tr>
                                    <td>{{$no + 1}}</td>
                                    <td>{{ $kirim->id_pesanan }}</td>
                                    <td>{{ $kirim->tanggal_pengiriman }}</td>
                                    <td>{{ $kirim->status }}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#detailPesananModal{{ $kirim->id_pengiriman }}">
                                            Lihat Detail
                                        </button>
                                    </td>
                                    <td>
                                        @if ($kirim->status == 'Dikirim')
                                            <form action="{{ route('terimaPengiriman', ['id' => $kirim->id_pengiriman]) }}"
                                                method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-success">
                                                    Diterima
                                                </button>
                                            </form>
                                        @else
                                            <span class="badge badge-success">Diterima</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>

    <!-- Modal Detail Pesanan -->
    <div class="modal fade" id="detailPesananModal{{ $kirim->id_pengiriman }}" tabindex="-1" role="dialog"
        aria-labelledby="detailPesananModalLabel{{ $kirim->id_pengiriman }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailPesananModalLabel{{ $kirim->id_pengiriman }}">Detail Pesanan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nama Produk</th>
                                <th>Jumlah</th>
                                <th>Harga Satuan</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kirim->detailPesanan as $detail)
                                <tr>
                                    <td>{{ $detail->nama_produk }}</td>
                                    <td>{{ $detail->qty }}</td>
                                    <td>Rp {{ number_format($detail->harga_satuan, 0, ',', '.') }}</td>
                                    <td>Rp {{ number_format($detail->qty * $detail->harga_satuan, 0, ',', '.') }}</td>
                                    @php
                                    $totalHargaSemuaPesanan += $qty->total_harga;
                                @endphp
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function terimaPesanan(id_pengiriman) {
            if (confirm('Anda yakin pesanan ini telah diterima?')) {
                axios.post(`/admin/pengiriman/${id_pengiriman}/terima`)
                    .then(response => {
                        alert('Pesanan berhasil diterima.');
                        window.location.reload();
                    })
                    .catch(error => {
                        console.error(error);
                        alert('Terjadi kesalahan saat memproses permintaan.');
                    });
            }
        }
    </script>

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection
