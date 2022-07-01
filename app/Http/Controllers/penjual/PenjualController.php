<?php

namespace App\Http\Controllers\penjual;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PenjualController extends Controller
{
    //
    public function index()
    {
        return view('penjual.dashboard');
    }
    public function storeToko(Request $request)
    {
        $request->validate([
            'title' => 'required|min:2'
        ]);

        try {
            return redirect('/home')->with('sukses', 'mantap');
        } catch (\Exception $e) {
            return redirect('/home')->with('gagal', 'sedih');
        }
    }
    public function updateToko(Request $request)
    { }
}
