<?php

namespace App\Http\Controllers\penjual;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Transaksi;
use App\Pengiriman;
class TransaksiController extends Controller
{
    //
    public function index()
    {
        $transaksi = Transaksi::where('toko_users_id', Auth::user()->id)->get();
        return view('penjual.transaksi', compact('transaksi'));
    }
    public function show($id)
    {
        $datapemesan = Transaksi::join('users', 'users.id', 'transaksi.users_id')->where('transaksi.idtransaksi', $id)->first();

        $databarang = Transaksi::join('transaksi_has_produk', 'transaksi_has_produk.transaksi_idtransaksi', '=', 'transaksi.idtransaksi')
            ->join('produk', 'produk.idproduk', '=', 'transaksi_has_produk.produk_idproduk')
            ->where('transaksi.idtransaksi', $id)
            ->select('transaksi_has_produk.*', 'produk.nama')
            ->get();
        $dataalamat = Transaksi::join('alamat', 'alamat.idalamat', '=', 'transaksi.alamat_idalamat')
            ->join('provinsi', 'provinsi.idprovinsi', '=', 'alamat.provinsi_idprovinsi')
            ->join('kotakabupaten', 'kotakabupaten.idkotakabupaten', 'alamat.kotakabupaten_idkotakabupaten')
            ->where('transaksi.idtransaksi', $id)
            ->select('alamat.*', 'kotakabupaten.nama as kabupaten', 'provinsi.nama as provinsi')
            ->first();

        return view('penjual.transaksidetail', compact('databarang', 'datapemesan', 'dataalamat'));
    }
    public function ubahstatus($id, $status)
    {
        DB::beginTransaction();
        try {
            if ($status == "Batal") {
                $transaksi = Transaksi::find($id);
                $transaksi->status = $status;
                $transaksi->save();
            } else if ($status == "Pesanan Diproses") {
                $transaksi = Transaksi::find($id);
                $transaksi->status = $status;
                $transaksi->save();
            } else if ($status == "Pesanan Dikirim") {
                $transaksi = Transaksi::find($id);
                $transaksi->status = $status;
                $transaksi->save();

                $pengiriman = new Pengiriman();
                $pengiriman->status = "Menunggu Plot Kurir";
                $pengiriman->transaksi_idtransaksi = $id;
                $pengiriman->save();

            } else {
                $transaksi = Transaksi::find($id);
                $transaksi->status = $status;
                $transaksi->save();
            }
            DB::commit();
            return redirect()->back()->with('sukses', 'Berhasil ubah status transaksi');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('gagal', $e->getMessage());
        }
    }
}
