<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuhuAirIot;

class SuhuAirController extends Controller
{
    public function suhuair()
    {
        $data = SuhuAirIot::select('waktu', 'nilaisuhu')->take(100)->get();
        return view ('admin.SuhuAir',compact('data'));
    } 


    public function uploadDatadarialat(Request $request)
    {
        // Ambil data yang dikirim dari NodeMCU
        $waktu = $request->input('waktu');
        $nilaiSuhu = $request->input('nilaisuhu');

        // Simpan data ke dalam database
        $data = new SuhuAirIot();
        $data->waktu = $waktu;
        $data->nilaisuhu = $nilaiSuhu;
        $data->save();

        return response()->json();
    }
}
