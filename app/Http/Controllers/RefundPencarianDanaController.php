<?php

namespace App\Http\Controllers;

use App\Refund;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Transaksi;
use PhpParser\Node\Stmt\Catch_;

class RefundPencarianDanaController extends Controller
{
    //

    public function indexPenjual()
    {
        $data_refund = Refund::where('toko_users_id', Auth::user()->id)->get();
        $data_transaksi = Transaksi::where('pencarian_penjual', 0)->where('status', 'Selesai')->get();
        return view('penjual.pencairandana', compact('data_transaksi', 'data_refund'));
    }
    public function storePenjual(Request $request)
    {
        try {
            $total = 0;
            $data_transaksi = Transaksi::where('pencarian_penjual', 0)->where('status', 'Selesai')->get();
            foreach ($data_transaksi as $value) {
                $total += ($value->total + $value->onkir);
            }
            $refund = new Refund();
            $refund->pemohon = "penjual";
            $refund->jumlah = $total;
            $refund->nama_rekening = $request->get('nama_rekening');
            $refund->nomor_rekening = $request->get('nomor_rekening');
            $refund->bank = $request->get('nama_bank');
            $refund->toko_users_id = Auth::user()->id;
            $refund->save();
            foreach ($data_transaksi as $value) {
                DB::table('detail_refund')->insert([
                    'transaksi_idtransaksi' => $value->idtransaksi,
                    'refund_idrefund' => $refund->idrefund
                ]);
                Transaksi::where('idtransaksi', $value->idtransaksi)->update(['pencarian_penjual' => 1]);
            }
            return redirect()->back()->with('sukses', 'Berhasil Membuat Data Refund');
        } catch (\Exception $e) {
            return redirect()->back()->with('gagal', $e->getMessage());
        }
    }
    public function indexPembeli()
    {
        $data_refund = Refund::where('users_id', Auth::user()->id)->get();
        $data_transaksi = Transaksi::where('refund_pembeli', 0)->where('status', 'Batal')->get();
        return view('pembeli.refund', compact('data_transaksi', 'data_refund'));
    }
    public function storePembeli(Request $request)
    {
        try {
            $total = 0;
            $data_transaksi = Transaksi::where('refund_pembeli', 0)->where('status', 'Batal')->get();
            foreach ($data_transaksi as $value) {
                $total += $value->total + $value->onkir;
            }
            $refund = new Refund();
            $refund->pemohon = "pembeli";
            $refund->jumlah = $total;
            $refund->nama_rekening = $request->get('nama_rekening');
            $refund->nomor_rekening = $request->get('nomor_rekening');
            $refund->bank = $request->get('nama_bank');
            $refund->users_id = Auth::user()->id;
            $refund->status = "Menunggu Konfirmasi Admin";
            $refund->save();
            foreach ($data_transaksi as $value) {
                DB::table('detail_refund')->insert([
                    'transaksi_idtransaksi' => $value->idtransaksi,
                    'refund_idrefund' => $refund->idrefund
                ]);
                Transaksi::where('idtransaksi', $value->idtransaksi)->update(['refund_pembeli' => 1]);
            }
            return redirect()->back()->with('sukses', 'Berhasil Membuat Data Refund');
        } catch (\Exception $e) {
            // return redirect()->back()->with('gagal', $e->getMessage());
            return $e->getMessage();
        }
    }
    public function detail($id)
    {
        $data_refund = Refund::where('idrefund', $id)->first();
        $detail_refund = DB::table('detail_refund')->join('transaksi', 'transaksi.idtransaksi', '=', 'detail_refund.transaksi_idtransaksi')
            ->where('detail_refund.refund_idrefund', $id)
            ->select('transaksi.idtransaksi', 'transaksi.created_at', 'transaksi.total')
            ->get();
        return response()->json([
            'data_refund' => $data_refund,
            'detail_refund' => $detail_refund
        ]);
    }
}
