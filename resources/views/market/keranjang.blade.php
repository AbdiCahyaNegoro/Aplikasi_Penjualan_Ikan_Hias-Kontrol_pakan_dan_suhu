@extends('layouts.market.masteheaderrmarket')

@section('title', 'Keranjang Belanja')

@section('isimarket')
    <div class="fashion_section">
        <div class="container">
            <br><br>
            <h1>KERANJANG BELANJA</h1><br><br>
            @if ($keranjang->isEmpty())
                <p>Keranjang belanja Anda kosong.</p>
            @else
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nama Produk</th>
                            <th>Jumlah</th>
                            <th>Harga Satuan</th>
                            <th>Total</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($keranjang as $item)
                            <tr>
                                <td>{{ $item->nama_produk }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>Rp. {{ number_format($item->harga_satuan, 0, ',', '.') }}</td>
                                <td>Rp. {{ number_format($item->quantity * $item->harga_satuan, 0, ',', '.') }}</td>
                                <td>
                                    <form action="{{ route('hapusItemKeranjang', $item->id_keranjang) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" style="font-size: 12px">delete</button>
                                    </form>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div>
                    <p>Total Harga: Rp. {{ number_format($totalHarga, 0, ',', '.') }}</p>
                    <a href="" class="btn btn-primary">Bayar</a>
                </div>
            @endif
        </div>
    </div>
@endsection
