@extends('layouts.market.masteheaderrmarket')

@section('title', 'Keranjang Belanja')

@section('isimarket')

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@elseif(session('error'))
<div class="alert alert-error">
    {{ session('error') }}
</div>
@endif

<div class="fashion_section">
        <div class="container">
            <h1>KERANJANG BELANJA</h1><br><br>
            @if ($keranjang->isEmpty())
                <p>Keranjang belanja Anda kosong.</p>
            @else
                <form action="{{ route('keranjangkepesanan') }}" method="POST">
                    @csrf
                    <table class="table">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="select-all"></th>
                                <th>Produk</th>
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
                                    <td>
                                        <input type="checkbox" class="item-checkbox" name="items[]"
                                            value="{{ $item->id_keranjang }}" data-quantity="{{ $item->quantity }}"
                                            data-price="{{ $item->harga_satuan }}">
                                    </td>
                                    <td><img src="{{ asset($item->folder . '/' . $item->nama_foto) }}"
                                            alt="{{ $item->nama_produk }}" style="max-width: 100px;"></td>
                                    <td>{{ $item->nama_produk }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>Rp. {{ number_format($item->harga_satuan, 0, ',', '.') }}</td>
                                    <td>Rp. {{ number_format($item->quantity * $item->harga_satuan, 0, ',', '.') }}</td>
                                    <td>
                                    </form>
                                        <form action="{{ route('hapusItemKeranjang', $item->id_keranjang) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"
                                                style="font-size: 12px">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div>
                        <p>Total Harga: Rp. <span id="totalHarga">0</span></p>
                        <button type="submit" class="btn btn-primary">Pesan</button>
                    </div>
             
            @endif
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkboxes = document.querySelectorAll('.item-checkbox');
            const totalHargaElement = document.getElementById('totalHarga');
            const selectAllCheckbox = document.getElementById('select-all');

            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', updateTotal);
            });

            selectAllCheckbox.addEventListener('change', function() {
                checkboxes.forEach(checkbox => {
                    checkbox.checked = this.checked;
                });
                updateTotal();
            });

            function updateTotal() {
                let totalHarga = 0;
                checkboxes.forEach(checkbox => {
                    if (checkbox.checked) {
                        totalHarga += checkbox.dataset.quantity * checkbox.dataset.price;
                    }
                });
                totalHargaElement.textContent = new Intl.NumberFormat('id-ID').format(totalHarga);
            }
        });
    </script>
@endsection
