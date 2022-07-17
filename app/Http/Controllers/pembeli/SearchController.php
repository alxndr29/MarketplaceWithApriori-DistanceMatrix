<?php

namespace App\Http\Controllers\pembeli;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Produk;

class SearchController extends Controller
{
    //
    public function index(Request $request)
    {
        // return $request->input('filter') ?  $request->input('filter') : "kosongan";
        $produk = Produk::join('gambar_produk', 'produk.idproduk', '=', 'gambar_produk.produk_idproduk')
            ->whereNull('gambar_produk.deleted_at')
            ->leftJoin('rating', 'rating.produk_idproduk', '=', 'produk.idproduk')
            ->groupBy('produk.idproduk')
            ->select('produk.*', 'gambar_produk.idgambar_produk', DB::raw("ROUND(AVG(rating.jumlah)) as rating"));
        if ($request->input('filter')) {
            $produk->where('produk.nama', 'like', '%' . $request->input('filter') . '%');
        }
        if ($request->input('kategori')) {
            $produk->where('produk.kategori_idkategori', $request->input('kategori'));
        }
        if ($request->input('rating')) {
            $produk->orderBy(DB::raw("AVG(rating.jumlah)"), $request->input('rating'));
        }
        if ($request->input('harga')) {
            $produk->orderBy('produk.harga', $request->input('harga'));
        }
        // return $produk->get();
        
        return view('pembeli.search', ['produk' => $produk->get()]);
    }
}
