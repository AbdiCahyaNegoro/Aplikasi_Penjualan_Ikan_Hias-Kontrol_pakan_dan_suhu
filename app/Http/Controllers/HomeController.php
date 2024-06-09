<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
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
    public function index(){
        return view ('index');
    }

    public function TidakBolehAkses(){
        return view ('403');
    }

    public function BerandaAdmin(){
        return view ('admin.beranda');
    }

    public function HalamUtamaPelanggan(){
        return view ('index');
    }

    public function tampildatauser()
    {
        // Menggunakan Query Builder untuk mendapatkan semua data dari tabel users
        $users = DB::table('users')->get();

        // Mengembalikan tampilan dengan data users
        return view('users.index', ['users' => $users]);
    }
}
