<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function tampildatauser()
    {
        // Menggunakan Query Builder untuk mendapatkan semua data dari tabel users
        $users = DB::table('users')->get();

        // Mengembalikan tampilan dengan data users
        return view('users.index', ['users' => $users]);
    }
}
