<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PakanIkanController extends Controller
{
    public function pakanikan(){
        return view ('admin.PakanIkan');
    }

    public function kasihmakan(Request $request)
    {
        // Tambahkan kode untuk mengendalikan servo di sini
        // Misalnya, Anda bisa mengirimkan perintah ke NodeMCU untuk menggerakkan servo

        return response()->json(['message' => 'Feed command sent successfully'], 200);
    }
}
