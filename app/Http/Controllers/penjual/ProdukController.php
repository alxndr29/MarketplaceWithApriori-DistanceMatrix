<?php

namespace App\Http\Controllers\penjual;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Produk;
use App\GambarProduk;

class ProdukController extends Controller
{
    //
    public function index()
    {
        $produk = Produk::join('gambar_produk','produk.idproduk','=','gambar_produk.produk_idproduk')
        ->where('produk.toko_users_id','=',Auth::user()->id)
        ->select('produk.*','gambar_produk.idgambar_produk')
        ->get();
        //return ($produk);
        return view('penjual.produk', compact('produk'));
    }
    public function store(Request $request)
    {
        $request->validate([
           
        ]);
        try {
            var_dump($request->get('files'));
            //return redirect()->back()->with('sukses', 'Berhasil menambah etalase baru');
        } catch (\Exception $e) {
            return redirect()->back()->with('gagal', $e->getMessage());
        }
    }
    public function update(Request $request, $id)
    {
        $request->validate([
           
        ]);
        try {
            
            return redirect()->back()->with('sukses', 'Berhasil menambah etalase baru');
        } catch (\Exception $e) {
            return redirect()->back()->with('gagal', $e->getMessage());
        }
    }
    public function delete($id)
    {
        try {
          
            return redirect()->back()->with('sukses', 'Berhasil meghapus etalase ');
        } catch (\Exception $e) {
            return redirect()->back()->with('gagal', $e->getMessage());
        }
    }
}
