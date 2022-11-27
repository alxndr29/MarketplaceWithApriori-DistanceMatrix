<?php

namespace App\Http\Controllers\pembeli;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Produk;
use App\Kategori;
use GuzzleHttp;
use App\Alamat;
use Illuminate\Support\Facades\Auth;

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
            ->leftJoin('users_has_produk', 'users_has_produk.produk_idproduk', '=', 'produk.idproduk')
            ->join('toko', 'produk.toko_users_id', '=', 'toko.users_id')
            ->groupBy('produk.idproduk')
            ->select('produk.*', 'gambar_produk.idgambar_produk', DB::raw("ROUND(AVG(users_has_produk.bintang)) as rating"), 'toko.latitude', 'toko.longitude');
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
        }
        if ($request->input('order')) {
            $order = $request->input('order');
            $produk->orderBy('produk.harga', $request->input('order'));
        }
        $produk->addSelect(DB::raw("'jarak' as fakeColumn"));
        $a = $produk->get();
        $alamat = Alamat::where('users_id', Auth::user()->id)->where('default', 1)->first();
        if ($alamat) {
            $latitude_origin = $alamat->latitude;
            $longitude_destination = $alamat->longitude;
            foreach ($a as $key => $value) {
                $client = new GuzzleHttp\Client();
                $request = new \GuzzleHttp\Psr7\Request('GET', 'https://maps.googleapis.com/maps/api/distancematrix/json?origins=' . $latitude_origin . '%2C' . $longitude_destination . '&destinations=' . $value->latitude . '%2C' . $value->longitude . '&key=AIzaSyA1MgLuZuyqR_OGY3ob3M52N46TDBRI_9k');
                $promise = $client->sendAsync($request)->then(function ($response) use ($value) {
                    $result = json_decode($response->getBody());
                    $hasil = $result->rows[0]->elements[0]->distance->text;
                    // echo $result->rows[0]->elements[0]->distance->value;
                    $value->jarak = $result->rows[0]->elements[0]->distance->text;
                });
                $promise->wait();
            }
        }
        // return $a;
        return view('pembeli.search', [
            'produk' => $a,
            'datakategori' => Kategori::all(),
            'filter' => $filter,
            'kategori' => $kategori,
            'rating' => $rating,
            'order' => $order
        ]);
    }
}
