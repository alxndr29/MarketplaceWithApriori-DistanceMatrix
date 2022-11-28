<?php

namespace App\Http\Controllers\penjual;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Produk;
use App\GambarProduk;
use App\EtalaseProduk;
use App\Kategori;
use Phpml\Association\Apriori;

class ProdukController extends Controller
{
    //
    public function index()
    {
        $produk = Produk::join('gambar_produk', 'produk.idproduk', '=', 'gambar_produk.produk_idproduk')
            ->where('produk.toko_users_id', '=', Auth::user()->id)
            ->whereNull('gambar_produk.deleted_at')
            ->groupBy('produk.idproduk')
            ->select('produk.*', 'gambar_produk.idgambar_produk')
            ->get();
        //return ($produk);
        return view('penjual.produk', compact('produk'));
    }
    public function add()
    {
        $etalase = EtalaseProduk::where('toko_users_id', Auth::user()->id)->get();
        $kategori = Kategori::all();
        return view('penjual.produkadd', compact('etalase', 'kategori'));
    }
    public function store(Request $request)
    {
        $request->validate([]);
        DB::beginTransaction();
        try {
            $produk = new Produk();
            $produk->nama = $request->get('nama');
            $produk->etalase_produk_idetalase_produk = $request->get('etalase');
            $produk->kategori_idkategori = $request->get('kategori');
            $produk->deskripsi = $request->get('deskripsi');
            $produk->toko_users_id = Auth::user()->id;
            $produk->harga = $request->get('harga');
            $produk->stok = $request->get('stok');
            $produk->save();
            if ($request->hasfile('files')) {
                foreach ($request->file('files') as $file) {
                    $file->move(public_path() . '/gambar_produk/', $file->getClientOriginalName());
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
    public function edit($id)
    {
        $etalase = EtalaseProduk::where('toko_users_id', Auth::user()->id)->get();
        $kategori = Kategori::all();
        $produk = Produk::where('idproduk', $id)->first();
        $gambar_produk = GambarProduk::where('produk_idproduk', $id)->get();
        // return $gambar_produk;
        return view('penjual.produkedit', compact('produk', 'etalase', 'kategori', 'gambar_produk'));
    }
    public function deleteGambarEdit($idproduk, $idgambar)
    {
        try {
            if (GambarProduk::where('produk_idproduk', $idproduk)->count() <= 1) {
                return redirect()->back()->with('gagal', 'Tidak dapat hapus gambar. produk ini setidaknya harus memiliki 1 gambar');
            } else {
                $image_path = "gambar_produk/" . $idgambar;
                if (\File::exists($image_path)) {
                    \File::delete($image_path);
                    GambarProduk::where('idgambar_produk', $idgambar)->delete();
                }
                return redirect()->back()->with('sukses', 'Berhasil Hapus Gambar');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('gagal', $e->getMessage());
        }
    }
    public function update(Request $request, $id)
    {
        $request->validate([]);
        try {
            $produk = Produk::find($id);
            $produk->nama = $request->get('nama');
            $produk->etalase_produk_idetalase_produk = $request->get('etalase');
            $produk->kategori_idkategori = $request->get('kategori');
            $produk->toko_users_id = Auth::user()->id;
            $produk->deskripsi = $request->get('deskripsi');
            $produk->harga = $request->get('harga');
            $produk->stok = $request->get('stok');
            $produk->save();
            if ($request->hasfile('files')) {
                foreach ($request->file('files') as $file) {
                    $file->move(public_path() . '/gambar_produk/', $file->getClientOriginalName());
                    $gambar_produk = new GambarProduk();
                    $gambar_produk->idgambar_produk = $file->getClientOriginalName();
                    $gambar_produk->produk_idproduk = $id;
                    $gambar_produk->save();
                }
            }
            return redirect()->back()->with('sukses', 'Berhasil menambah etalase baru');
        } catch (\Exception $e) {
            return redirect()->back()->with('gagal', $e->getMessage());
        }
    }
    public function delete($id)
    {
        try {
            $produk = Produk::find($id);
            $produk->delete();
            return redirect()->back()->with('sukses', 'Berhasil meghapus etalase ');
        } catch (\Exception $e) {
            return redirect()->back()->with('gagal', $e->getMessage());
        }
    }
    public function detail($id)
    {
        $produk = Produk::where('idproduk', $id)
            ->join('toko', 'toko.users_id', '=', 'produk.toko_users_id')
            ->select('produk.*', 'toko.nama_toko as namatoko', 'toko.users_id as idtoko')
            ->first();

        $avg = DB::table('users_has_produk')->where('produk_idproduk', $id)->avg('bintang');

        $gambar_produk = GambarProduk::where('produk_idproduk', $id)->get();

        $review = DB::table('users_has_produk')
            ->where('produk_idproduk', $id)
            ->join('users', 'users.id', '=', 'users_has_produk.users_id')
            ->select('users_has_produk.*', 'users.name')
            ->get();
        //apriori
        $detailtransaksi = DB::table('transaksi_has_produk')
            ->orderBy('transaksi_idtransaksi')
            ->get();
        $data = [];

        foreach ($detailtransaksi as $item) {
            if (!array_key_exists($item->transaksi_idtransaksi, $data)) {
                $data[$item->transaksi_idtransaksi] = [];
            }
            array_push($data[$item->transaksi_idtransaksi], $item->produk_idproduk);
        }

        $labels  = [];
        $support = 0;
        $confidence = 0;
        $associator = new Apriori($support, $confidence);
        $associator->train($data, $labels);
        $result =  $associator->getRules();

        $rekomendasi = [];
        foreach ($result as $value) {
            if (count($value['antecedent']) == 1) {
                if ($value['antecedent'][0] == $id) {
                    //return "dapet";
                    foreach ($value['consequent'] as $kon) {
                        if (in_array($kon, $rekomendasi)) { } else {
                            array_push($rekomendasi, $kon);
                        }
                    }
                }
            }
        }
        $hasilAkhirRekomendasi = [];
        if (count($rekomendasi) != 0) {
            foreach ($rekomendasi as $rek) {
                $a = Produk::join('gambar_produk', 'produk.idproduk', '=', 'gambar_produk.produk_idproduk')
                    ->whereNull('gambar_produk.deleted_at')
                    ->where('produk.idproduk', $rek)
                    ->leftJoin('users_has_produk', 'users_has_produk.produk_idproduk', '=', 'produk.idproduk')
                    ->groupBy('produk.idproduk')
                    ->select('produk.*', 'gambar_produk.idgambar_produk', DB::raw("ROUND(AVG(users_has_produk.bintang)) as rating"))->first();
                array_push($hasilAkhirRekomendasi, $a);
            }
        } else {
            $hasilAkhirRekomendasi = Produk::join('gambar_produk', 'produk.idproduk', '=', 'gambar_produk.produk_idproduk')
                ->whereNull('gambar_produk.deleted_at')
                ->where('produk.idproduk', '!=', $id)
                ->leftJoin('users_has_produk', 'users_has_produk.produk_idproduk', '=', 'produk.idproduk')
                ->groupBy('produk.idproduk')
                ->select('produk.*', 'gambar_produk.idgambar_produk', DB::raw("ROUND(AVG(users_has_produk.bintang)) as rating"))->get();
        }

        return view('pembeli.detailproduk', compact('produk', 'gambar_produk', 'avg', 'review', 'hasilAkhirRekomendasi'));
    }
    public function detailReview($id)
    { }
}
