<!-- Modal -->
<div class="modal fade" id="modalPembelian" tabindex="-1" role="dialog" aria-labelledby="modalPembelianLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalPembelianLabel">Pembelian Produk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <!-- Informasi Produk -->
                        <div class="mb-3">
                            <h5>Detail Produk</h5>
                            <p>Nama Produk: <strong id="detailNamaProduk"></strong></p>
                            <p>Harga: <strong id="detailHargaProduk"></strong></p>
                            <!-- Tambahkan informasi lain yang diperlukan -->
                        </div>
                        <!-- Form Pembelian -->
                        <div class="mb-3">
                            <h5>Detail Pembelian</h5>
                            <!-- Tambahkan form untuk opsi pembelian, seperti jumlah, alamat pengiriman, dll -->
                            <!-- Contoh: -->
                            <div class="form-group">
                                <label for="jumlah">Jumlah:</label>
                                <input type="number" class="form-control" id="jumlah" name="jumlah" value="1" min="1">
                            </div>
                            <!-- Tambahkan opsi pembayaran, dll -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <!-- Tombol untuk menyelesaikan pembelian -->
                <button type="button" class="btn btn-primary" id="selesaikanPembelian">Selesaikan Pembelian</button>
            </div>
        </div>
    </div>
</div>
