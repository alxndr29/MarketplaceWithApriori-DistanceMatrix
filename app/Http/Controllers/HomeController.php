<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Produk;
use App\Kategori;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index2()
    {
        // if(Auth::user()->role == "penjual"){
        //     return 'hello world';
        // }else if(Auth::user()->role == "pembeli"){
            
        // }else if(Auth::user()->role == "admin"){

        // }
        $filter = "";
        $kategori = null;
        $rating = null;
        $order = null;
        // return $request->input('filter') ?  $request->input('filter') : "kosongan";
        $produk = Produk::join('gambar_produk', 'produk.idproduk', '=', 'gambar_produk.produk_idproduk')
            ->whereNull('gambar_produk.deleted_at')
            ->leftJoin('users_has_produk', 'users_has_produk.produk_idproduk', '=', 'produk.idproduk')
            ->groupBy('produk.idproduk')
            ->select('produk.*', 'gambar_produk.idgambar_produk', DB::raw("ROUND(AVG(users_has_produk.bintang)) as rating"));
        return view('home',[
            'produk' => $produk->get(),
            'datakategori' => Kategori::all(),
            'filter' => $filter,
            'kategori' => $kategori,
            'rating' => $rating,
            'order' => $order
            ]);
    }
    public function index(){
        $filter = "";
        $kategori = null;
        $rating = null;
        $order = null;
        // return $request->input('filter') ?  $request->input('filter') : "kosongan";
        $produk = Produk::join('gambar_produk', 'produk.idproduk', '=', 'gambar_produk.produk_idproduk')
            ->whereNull('gambar_produk.deleted_at')
            ->leftJoin('users_has_produk', 'users_has_produk.produk_idproduk', '=', 'produk.idproduk')
            ->groupBy('produk.idproduk')
            ->select('produk.*', 'gambar_produk.idgambar_produk', DB::raw("ROUND(AVG(users_has_produk.bintang)) as rating"));
        return view('pembeli.home',[
            'produk' => $produk->get(),
            'datakategori' => Kategori::all(),
            'filter' => $filter,
            'kategori' => $kategori,
            'rating' => $rating,
            'order' => $order
            ]);
    }
}
