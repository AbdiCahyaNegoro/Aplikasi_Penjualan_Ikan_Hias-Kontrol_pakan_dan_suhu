<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\produk;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{

    /**
     * Create a new controller instance.
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $produk = produk::all();
        // Kirim data ke view
        return view('index', compact('produk'));
    }

    public function BerandaAdmin()
    {
        // Logic untuk halaman beranda admin
        return view('admin.beranda');
    }

    public function Profile()
    {
        // Logic untuk halaman beranda admin
        return view('Profile');
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
    
        // Validasi data yang dikirim dari form
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'alamat' => ['required', 'string'],
            'tanggallahir' => ['required', 'date'],
            'jeniskelamin' => ['required', 'string'],
            'foto' => ['nullable', 'image', 'max:2048'], // Foto harus berupa gambar dengan ukuran maksimal 2MB
        ]);
    
        // Update data profil pengguna
        DB::table('users')
            ->where('id', $user->id)
            ->update([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'alamat' => $validatedData['alamat'],
                'tanggallahir' => $validatedData['tanggallahir'],
                'jeniskelamin' => $validatedData['jeniskelamin'],
            ]);
    
        // Periksa apakah ada file foto yang diunggah
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $folder = 'assets/img/user';
    
            // Simpan foto ke direktori yang diinginkan
            $filename = $foto->getClientOriginalName();
            $foto->move(public_path($folder), $filename);
    
            // Update nama file dan folder di database
            DB::table('users')
                ->where('id', $user->id)
                ->update([
                    'foto' => $filename,
                    'folder' => $folder,
                ]);
        }
    
        return redirect()->route('Profile')
            ->with('success', 'Profile updated successfully.');
    }
    
}
