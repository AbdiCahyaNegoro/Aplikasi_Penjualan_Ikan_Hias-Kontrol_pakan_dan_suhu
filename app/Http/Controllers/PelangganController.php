<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function pelanggan(){
        $users = User::all(); // Mengambil semua data pengguna
        return view('admin.pelanggan', compact('users'));
    }
}
