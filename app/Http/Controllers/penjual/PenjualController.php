<?php

namespace App\Http\Controllers\penjual;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Toko;
use App\Produk;
use App\KotaKabupaten;

class PenjualController extends Controller
{
    //
    public function dashboard()
    {
        return view('penjual.dashboard');
    }
    public function regisToko()
    {
        return view('penjual.registrasi_toko');
    }
    public function storeToko(Request $request)
    {
        $request->validate([
            'nama_toko' => 'required|min:10'
        ]);
        try {
            $toko = new Toko();
            $toko->nama_toko = $request->get('nama_toko');
            $toko->users_id = Auth::user()->id;
            $toko->save();
            return redirect('/seller/halamanupdatetoko')->with('sukses', 'Berhasil Melakukan Registrasi Toko');
        } catch (\Exception $e) {
            return $e->getMessage();
            return back()->with('gagal', $e->getMessage());
        }
    }
    public function halamanUpdateToko()
    {
        $data = Toko::where('users_id', Auth::user()->id)->first();
        $kotakabupaten = KotaKabupaten::where('provinsi_idprovinsi',22)->get();
        return view('penjual.update_toko', compact('data','kotakabupaten'));
    }
    public function updateToko(Request $request)
    {
        // return $request->all();
        $request->validate([
            'nama_toko' => 'required',
            'deskripsi' => 'required',
            'status' => 'required'
        ]);
        try {
            Toko::where('users_id', Auth::user()->id)->update([
                'nama_toko' => $request->get('nama_toko'),
                'deskripsi' => $request->get('deskripsi'),
                'status' => $request->get('status'),
                'alamat' => $request->get('alamat'),
                'telepon' => $request->get('telepon'),
                'latitude' => $request->get('latitude'),
                'longitude' => $request->get('longitude'),
                'kotakabupaten_idkotakabupaten' => $request->get('kotakabupaten')
            ]);
            return redirect('/seller/halamanupdatetoko')->with('sukses', 'Berhasil Melakukan Update Data Toko');
        } catch (\Exception $e) {
            return $e->getMessage();
            return back()->with('gagal', $e->getMessage());
        }
    }
    public function ambilLokasi(){
        try{
            $lokasi = Toko::all();
            return response()->json([
                'lokasi' => $lokasi
            ]);
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }
    public function detailToko($id){
        try{
            // return 'masuk halaman detail toko id: '. $id;
            $toko = Toko::where('users_id',$id)->first();
            // dd($toko);
            $produk = Produk::join('gambar_produk', 'produk.idproduk', '=', 'gambar_produk.produk_idproduk')
                ->whereNull('gambar_produk.deleted_at')
                ->where('produk.toko_users_id',$id)
                ->leftJoin('users_has_produk', 'users_has_produk.produk_idproduk', '=', 'produk.idproduk')
                ->groupBy('produk.idproduk')
                ->select('produk.*', 'gambar_produk.idgambar_produk', DB::raw("ROUND(AVG(users_has_produk.bintang)) as rating"))->get();
            $review = DB::table('users_has_produk')
                ->join('users', 'users.id', '=', 'users_has_produk.users_id')
                ->join('transaksi','transaksi.idtransaksi','=','users_has_produk.transaksi_idtransaksi')
                ->where('transaksi.toko_users_id',$id)
                ->select('users_has_produk.*', 'users.name')
                ->get();
            $avg = DB::table('users_has_produk')
            ->join('transaksi', 'transaksi.idtransaksi', '=', 'users_has_produk.transaksi_idtransaksi')
            ->where('transaksi.toko_users_id',$id)
            ->select(DB::raw('avg(users_has_produk.bintang) as avg'))
            ->first();
            return view('pembeli.detailpenjual', compact('produk','review','toko', 'avg'));
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }
}
