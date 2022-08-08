<?php

namespace App\Http\Controllers\penjual;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Transaksi;

class TransaksiController extends Controller
{
    //
    public function index(){
        $transaksi = Transaksi::where('toko_users_id',Auth::user()->id)->get();
        return view('penjual.transaksi',compact('transaksi'));
    }
    public function show($id){
        $datapemesan = Transaksi::join('users','users.id','transaksi.users_id')->where('transaksi.idtransaksi',$id)->first();
        // dd($datapemesan);
        $databarang = Transaksi::join('transaksi_has_produk','transaksi_has_produk.transaksi_idtransaksi','=','transaksi.idtransaksi')
        ->join('produk','produk.idproduk','=','transaksi_has_produk.produk_idproduk')
        ->where('transaksi.idtransaksi',$id)
        ->select('transaksi_has_produk.*','produk.nama')
        ->get();
        $dataalamat = Transaksi::join('alamat','alamat.idalamat','=','transaksi.alamat_idalamat')
        ->join('provinsi','provinsi.idprovinsi','=','alamat.provinsi_idprovinsi')
        ->join('kotakabupaten','kotakabupaten.idkotakabupaten','alamat.kotakabupaten_idkotakabupaten')
        ->where('transaksi.idtransaksi',$id)
        ->select('alamat.*','kotakabupaten.nama as kabupaten','provinsi.nama as provinsi')
        ->first();
        // dd($dataalamat);
        // return $databarang;
        return view('penjual.transaksidetail',compact('databarang','datapemesan', 'dataalamat'));
    }
}
