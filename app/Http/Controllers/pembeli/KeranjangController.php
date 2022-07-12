<?php

namespace App\Http\Controllers\pembeli;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class KeranjangController extends Controller
{
    //
    public function index()
    { }
    public function store(Request $request)
    {
        try {
            DB::table('keranjang')->updateOrInsert(
                [
                    'users_id' => Auth::user()->id,
                    'produk_idproduk' => $request->get('idproduk')
                ],
                [
                    'jumlah' => $request->get('jumlah')
                ]
            );
            return "berhasil";
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    public function keranjangNotif()
    {
        $keranjang = DB::table('keranjang')
        ->join('produk','produk.idproduk','=','keranjang.produk_idproduk')
        ->join('gambar_produk','produk.idproduk','=','gambar_produk.produk_idproduk')
        ->select('keranjang.jumlah','gambar_produk.idgambar_produk','produk.nama','produk.harga')
        ->groupBy('produk.idproduk')
        ->get();
        return response()->json([
            'keranjang' => $keranjang
        ]);
    }
    public function destroy($id)
    { }
}
