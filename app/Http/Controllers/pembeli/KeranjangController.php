<?php

namespace App\Http\Controllers\pembeli;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Produk;
use App\Alamat;

class KeranjangController extends Controller
{
    //
    public function index()
    {
        $alamat = Alamat::where('users_id', Auth::user()->id)->get();
        $a = DB::table('keranjang')
            ->join('produk', 'produk.idproduk', '=', 'keranjang.produk_idproduk')
            ->join('toko', 'toko.users_id', '=', 'produk.toko_users_id')
            ->where('keranjang.users_id', Auth::user()->id)
            ->select('produk.toko_users_id', 'toko.nama_toko','toko.latitude','toko.longitude')
            ->groupBy('produk.toko_users_id')
            ->get();
        //return $a;
        $b = DB::table('keranjang')
            ->join('produk', 'produk.idproduk', '=', 'keranjang.produk_idproduk')
            ->join('gambar_produk', 'produk.idproduk', '=', 'gambar_produk.produk_idproduk')
            ->where('keranjang.users_id', Auth::user()->id)
            ->select('keranjang.jumlah', 'gambar_produk.idgambar_produk', 'produk.nama', 'produk.idproduk', 'produk.harga', 'produk.toko_users_id')
            ->groupBy('produk.idproduk')
            ->get();
        //return $b;
        return view('pembeli.keranjang', compact('a', 'b', 'alamat'));
    }
    public function updateKeranjang(Request $request, $id)
    {
        try {
            $produk = Produk::find($id);
            if ($request->get('jumlah') <= ($produk->stok)) {
                DB::table('keranjang')->where('users_id', Auth::user()->id)->where('produk_idproduk', $id)->update(
                    [
                        'jumlah' => $request->get('jumlah')
                    ]
                );
                return redirect()->back()->with('sukses', 'Berhasil update qty keranjang');
            } else {
                return redirect()->back()->with('gagal', 'Jumlah tidak boleh lebih dari stok yang tersedia. ' . $produk->stok . ' pcs');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('gagal', $e->getMessage());
        }
    }
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
            ->join('produk', 'produk.idproduk', '=', 'keranjang.produk_idproduk')
            ->join('gambar_produk', 'produk.idproduk', '=', 'gambar_produk.produk_idproduk')
            ->select('keranjang.jumlah', 'gambar_produk.idgambar_produk', 'produk.nama', 'produk.harga')
            ->where('keranjang.users_id', Auth::user()->id)
            ->groupBy('produk.idproduk')
            ->get();
        return response()->json([
            'keranjang' => $keranjang
        ]);
    }
    public function destroy($id)
    {
        try {
            DB::table('keranjang')->where('keranjang.users_id', Auth::user()->id)->where('produk_idproduk', $id)->delete();
            return redirect()->back()->with('sukses', 'Berhasil hapus keranjang');
        } catch (\Exception $e) {
            return redirect()->back()->with('gagal', 'Gagal hapus keranjang');
        }
    }
}
