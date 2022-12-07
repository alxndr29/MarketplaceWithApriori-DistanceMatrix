<?php

namespace App\Http\Controllers\penjual;

use App\Http\Controllers\Controller;
use App\Kurir;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Transaksi;
use App\Pengiriman;

class PengirimanController extends Controller
{
    //
    public function index()
    {
        $data = Transaksi::where('toko_users_id', Auth::user()->id)
            ->join('pengiriman', 'pengiriman.transaksi_idtransaksi', '=', 'transaksi.idtransaksi')
            ->groupBy('pengiriman.idpengiriman')
            ->select('transaksi.idtransaksi', 'transaksi.status as statustransaksi', 'pengiriman.status as statuspengiriman')
            ->get();
        // return $data;
        return view('penjual.pengiriman', compact('data'));
    }
    public function show($id)
    {

        $datapemesan = Transaksi::join('users', 'users.id', 'transaksi.users_id')->where('transaksi.idtransaksi', $id)->first();

        $databarang = Transaksi::join('detail_transaksi', 'detail_transaksi.transaksi_idtransaksi', '=', 'transaksi.idtransaksi')
            ->join('produk', 'produk.idproduk', '=', 'detail_transaksi.produk_idproduk')
            ->where('transaksi.idtransaksi', $id)
            ->select('detail_transaksi.*', 'produk.nama')
            ->get();
        $dataalamat = Transaksi::join('alamat', 'alamat.idalamat', '=', 'transaksi.alamat_idalamat')
            ->join('provinsi', 'provinsi.idprovinsi', '=', 'alamat.provinsi_idprovinsi')
            ->join('kotakabupaten', 'kotakabupaten.idkotakabupaten', 'alamat.kotakabupaten_idkotakabupaten')
            ->where('transaksi.idtransaksi', $id)
            ->select('alamat.*', 'kotakabupaten.nama as kabupaten', 'provinsi.nama as provinsi')
            ->first();

        $kurir = Kurir::where('toko_users_id', Auth::user()->id)->get();

        $datapengiriman = Pengiriman::where('transaksi_idtransaksi', $id)
            ->leftJoin('kurir', 'kurir.idkurir', '=', 'pengiriman.kurir_idkurir')
            ->select('pengiriman.*', 'kurir.nama')
            ->first();
        // dd($datapengiriman);
        // return view('penjual.transaksidetail', compact('databarang', 'datapemesan', 'dataalamat'));
        return view('penjual.pengirimandetail', compact('databarang', 'datapemesan', 'dataalamat', 'kurir', 'datapengiriman'));
    }
    
    public function plotkurir(Request $request)
    {
        // return $request->all();
        try {
            if ($request->get('kurir') != "Pilih Kurir") {
                $pengiriman = Pengiriman::where('transaksi_idtransaksi', $request->get('idtransaksi'))->first();
                $pengiriman->status = "Menunggu Pickup Kurir";
                $pengiriman->kurir_idkurir = $request->get('kurir');
                $pengiriman->save();
                return redirect()->back()->with('sukses', 'Berhasil Plot Kurir');
            } else {
                return redirect()->back()->with('gagal', 'Plot Kurir Gagal. Pastikan kamu sudah memilih kurir.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('gagal', $e->getMessage());
        }
    }
}
