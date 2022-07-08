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
        $produk = Produk::join('gambar_produk', 'produk.idproduk', '=', 'gambar_produk.produk_idproduk')
            ->where('produk.toko_users_id', '=', Auth::user()->id)
            ->select('produk.*', 'gambar_produk.idgambar_produk')
            ->get();
        //return ($produk);
        return view('penjual.produk', compact('produk'));
    }
    public function store(Request $request)
    {
        $request->validate([

        ]);
        DB::beginTransaction();
        try {
            $produk = new Produk();
            $produk->nama = $request->get('nama');
            $produk->etalase_produk_idetalase_produk = 1;
            $produk->kategori_idkategori = 1;
            $produk->toko_users_id = Auth::user()->id;
            $produk->save();
            if ($request->hasfile('files')) {
                foreach ($request->file('files') as $file) {
                    $file->move(public_path().'/gambar_produk/', $file->getClientOriginalName());  
                    $gambar_produk = new GambarProduk();
                    $gambar_produk->idgambar_produk = $file->getClientOriginalName();
                    $gambar_produk->produk_idproduk = $produk->idproduk;
                    $gambar_produk->save();
                }
            }
            DB::commit();
            return redirect()->back()->with('sukses', 'Berhasil menambah produk baru');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('gagal', $e->getMessage());
        }
    }
    public function update(Request $request, $id)
    {
        $request->validate([]);
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
