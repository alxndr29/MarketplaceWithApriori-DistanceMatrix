<?php

namespace App\Http\Controllers\pembeli;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Alamat;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Provinsi;
use App\KotaKabupaten;

class AlamatController extends Controller
{
    //
    public function index()
    {
        $provinsi = Provinsi::all();
        $kotakabupaten = KotaKabupaten::all();
        return view('pembeli.alamat', compact('provinsi', 'kotakabupaten'));
    }
}
