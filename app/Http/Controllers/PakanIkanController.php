<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PakanIkanController extends Controller
{
    public function pakanikan(){
        return view ('admin.PakanIkan');
    }
}
