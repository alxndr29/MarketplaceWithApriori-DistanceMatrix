<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Refund;
use App\Transaksi;
class AdminController extends Controller
{
    //
    public function index(){
        return view('admin.index');
    }
    public function onkir(){
        $data = DB::table('konfigurasi')->first();
        return view('admin.onkir', compact('data'));
    }
    public function setOnkir(Request $request)
    {
        try{
            DB::table('konfigurasi')->update(['harga_ongkir' => $request->get('harga_ongkir')]);
            return back()->with('sukses', 'BErhasil ubah.');
        }catch(\Exception $e){
            return back()->with('gagal', $e->getMessage());
        }
        return view('admin.onkir', compact('data'));
    }
    public function refund(){
        $daftar_refund = Refund::where('pemohon','pembeli')->get();
        return view('admin.refund', compact('daftar_refund'));
    }
    public function pencairan(){
        $daftar_pencairan = Refund::where('pemohon', 'penjual')->get();
        return view('admin.pencarian', compact('daftar_pencairan'));
    }
}
