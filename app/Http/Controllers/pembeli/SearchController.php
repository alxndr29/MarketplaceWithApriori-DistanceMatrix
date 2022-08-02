<?php

namespace App\Http\Controllers\pembeli;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Produk;
use App\Kategori;

class SearchController extends Controller
{
    //
    public function index(Request $request)
    {
        $filter = "";
        $kategori = null;
        $rating = null;
        $order = null;
        // return $request->input('filter') ?  $request->input('filter') : "kosongan";
        $produk = Produk::join('gambar_produk', 'produk.idproduk', '=', 'gambar_produk.produk_idproduk')
            ->whereNull('gambar_produk.deleted_at')
            ->leftJoin('rating', 'rating.produk_idproduk', '=', 'produk.idproduk')
            ->groupBy('produk.idproduk')
            ->select('produk.*', 'gambar_produk.idgambar_produk', DB::raw("ROUND(AVG(rating.jumlah)) as rating"));
        if ($request->input('filter')) {
            $filter = $request->input('filter');
            $produk->where('produk.nama', 'like', '%' . $request->input('filter') . '%');
        }
        if ($request->input('kategori')) {
            $kategori = $request->input('kategori');
            $produk->where('produk.kategori_idkategori', $request->input('kategori'));
        }
        if ($request->input('rating')) {
            $rating = $request->input('rating');
            // $produk->where(DB::raw("ROUND(AVG(rating.jumlah))"));
        }
        if ($request->input('order')) {
            $order = $request->input('order');
            $produk->orderBy('produk.harga', $request->input('order'));
        }
        // return $produk->get();
        return view('pembeli.search', [
            'produk' => $produk->get(),
            'datakategori' => Kategori::all(),
            'filter' => $filter,
            'kategori' => $kategori,
            'rating' => $rating,
            'order' => $order
        ]);
    }
}
