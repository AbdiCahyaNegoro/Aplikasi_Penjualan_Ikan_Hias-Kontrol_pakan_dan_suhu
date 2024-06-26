<?php

namespace App\Http\Controllers;

use App\Models\produk;
use App\Models\jenisproduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function tampildataproduk()
    {
        // Ambil semua data produk dari database
        $produk = produk::all();

        // Kirim data ke view
        return view('index', compact('produk'));
    }


    public function detailproduk($idproduk)
    {
        // Ambil Data Produk
        $produk = Produk::where('produk.id_produk', $idproduk)
            ->leftjoin('jenisproduk', 'produk.jenisproduk_id', '=', 'jenisproduk.id_jenisproduk')
            ->first();

        // Jika data produk ditemukan
        if ($produk) {
            // Kembalikan view dengan detail produk
            return view('market.detailproduk', ['produk' => $produk]);
        } else {
            // Jika data produk tidak ditemukan, kembalikan halaman error atau tindakan yang sesuai
            return redirect()->back()->with('error', 'Produk tidak ditemukan.');
        }
    }

    public function admintampildataproduk()
    {
        // Ambil semua data produk dari database dengan left join ke tabel jenisproduk
        $produk = Produk::leftJoin('jenisproduk', 'produk.jenisproduk_id', '=', 'jenisproduk.id_jenisproduk')
            ->select('produk.*', 'jenisproduk.jenis')
            ->get();

        // Ambil semua data jenis ikan
        $jenisproduk = JenisProduk::all();

        // Kirim data ke view
        return view('admin.produk', compact('produk', 'jenisproduk'));
    }


    public function formtambahproduk()
    {
        $jenisproduk = JenisProduk::all();
        return view('admin.TambahProduk', compact('jenisproduk'));
    }

    public function admintambahproduk(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_produk' => 'required|string|max:100',
            'harga_satuan' => 'required|numeric',
            'stok' => 'required|integer',
            'jenisproduk_id' => 'required|integer',
            'deskripsiproduk' => 'required|string',
            'nama_foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Mendapatkan file yang diupload
        $file = $request->file('nama_foto');

        // Simpan file foto dengan nama sesuai nama produk
        $fotoName = $request->nama_produk . '.' . $file->getClientOriginalExtension();
        $destinationPath = public_path('assets/img/produk');

        // Pindahkan file ke direktori tujuan
        $file->move($destinationPath, $fotoName);

        // Buat produk baru
        Produk::create([
            'nama_produk' => $request->nama_produk,
            'harga_satuan' => $request->harga_satuan,
            'stok' => $request->stok,
            'jenisproduk_id' => $request->jenisproduk_id,
            'deskripsiproduk' => $request->deskripsiproduk,
            'nama_foto' => $fotoName,
            'folder' => 'assets/img/produk',
        ]);

        // Redirect dan berikan pesan sukses
        return redirect()->route('admin.simpanproduk')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function adminubahProduk(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga_satuan' => 'required|numeric',
            'stok' => 'required|integer',
            'jenisproduk_id' => 'required|exists:jenisproduk,id_jenisproduk',
            'deskripsiproduk' => 'required|string',
            'nama_foto' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Contoh validasi untuk file foto
        ]);

        // Cari produk berdasarkan ID
        $produk = Produk::find($id);

        // Update data produk
        $produk->nama_produk = $request->nama_produk;
        $produk->harga_satuan = $request->harga_satuan;
        $produk->stok = $request->stok;
        $produk->jenisproduk_id = $request->jenisproduk_id;
        $produk->deskripsiproduk = $request->deskripsiproduk;

        // Cek apakah ada file foto baru yang diunggah
        if ($request->hasFile('nama_foto')) {
            // Proses file foto baru
            $file = $request->file('nama_foto');
            $fileName = $file->getClientOriginalName();
            $destinationPath = public_path('assets/img/produk');
            $file->move($destinationPath, $fileName);

            // Update nama file foto dalam database
            $produk->nama_foto = $fileName;
        }

        // Simpan perubahan
        $produk->save();

        // Redirect dengan pesan sukses
        return redirect()->route('admin.tambahproduk')->with('success', 'Produk berhasil diubah.');
    }


    public function adminsimpanubahProduk(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga_satuan' => 'required|numeric',
            'stok' => 'required|integer',
            'nama_foto' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validasi file foto
        ]);

        // Mulai transaksi database
        DB::beginTransaction();

            // Ambil data produk berdasarkan ID
            $produk = DB::table('produk')->where('id_produk', $id)->first();

            // Update data produk
            DB::table('produk')->where('id_produk', $id)->update([
                'nama_produk' => $request->nama_produk,
                'harga_satuan' => $request->harga_satuan,
                'stok' => $request->stok,
                'deskripsiproduk' => $request->deskripsiproduk,
            ]);

            // Cek apakah ada file foto baru yang diunggah
            if ($request->hasFile('nama_foto')) {
                // Proses file foto baru
                $file = $request->file('nama_foto');
                $fileName = $file->getClientOriginalName();
                $destinationPath = public_path('assets/img/produk');
                $file->move($destinationPath, $fileName);

                // Hapus foto lama jika ada
                $oldPhotoPath = $produk->folder . '/' . $produk->nama_foto;
                if (file_exists($oldPhotoPath)) {
                    unlink($oldPhotoPath);
                }

                // Update nama file foto dalam database
                DB::table('produk')->where('id_produk', $id)->update([
                    'nama_foto' => $fileName,
                ]);
            }

            // Commit transaksi jika berhasil
            DB::commit();

            // Redirect dengan pesan sukses
            return redirect()->route('tampilproduk')->with('success', 'Produk berhasil diupdate.');
    }

    public function formjenisproduk(Request $request)
    {
        $jenisproduk = jenisproduk::all();
        return view('admin.jenisikan', compact('jenisproduk'));
    }

    public function admintambahjenis(Request $request)
    {
        // Validasi input
        $request->validate([
            'jenis' => 'required|string|max:100',
        ]);

        // Simpan data jenis ikan baru
        DB::table('jenisproduk')->insert([
            'jenis' => $request->jenis,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('admin.simpanjenis')->with('success', 'Jenis ikan berhasil ditambahkan.');
    }

    public function hapusJenisProduk($id)
    {
        // Hapus jenis produk berdasarkan ID
        DB::table('jenisproduk')->where('id_jenisproduk', $id)->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('admin.tambahjenis')->with('success', 'Jenis produk berhasil dihapus.');
    }
}
