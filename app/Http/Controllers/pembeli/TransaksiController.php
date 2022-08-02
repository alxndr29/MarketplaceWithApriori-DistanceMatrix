<?php

namespace App\Http\Controllers\pembeli;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Transaksi;
use App\Produk;

class TransaksiController extends Controller
{
    //
    public function index()
    {
        // // Set your Merchant Server Key
        // \Midtrans\Config::$serverKey = 'SB-Mid-server-yj9hNmncUrqOhEvf1k3JSmPX';
        // // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        // \Midtrans\Config::$isProduction = false;
        // // Set sanitization on (default)
        // \Midtrans\Config::$isSanitized = true;
        // // Set 3DS transaction for credit card to true
        // \Midtrans\Config::$is3ds = true;

        // $params = array(
        //     'transaction_details' => array(
        //         'order_id' => 2012,
        //         'gross_amount' => 20000,
        //     ),
        //     'customer_details' => array(
        //         'first_name' => 'Alexander',
        //         'email' => 'alexevan2810@gmail.com',
        //         'phone' => '08111222333',
        //     ),
        // );
        // $snapToken = \Midtrans\Snap::getSnapToken($params);
        // return view('midtrans', compact('snapToken'));

        $transaksi = Transaksi::where('users_id', Auth::user()->id)->get();
        return view('pembeli.transaksi', compact('transaksi'));
    }
    public function store(Request $request)
    {
        // return $request->all();
        // return $request->get('idtoko');
        // return 'a';
        DB::beginTransaction();
        try {
            $keranjang = DB::table('keranjang')
                ->join('produk', 'produk.idproduk', '=', 'keranjang.produk_idproduk')
                ->where('users_id', Auth::user()->id)
                ->where('produk.toko_users_id', '=', $request->get('idtoko'))
                ->select('keranjang.*', 'produk.harga', 'produk.idproduk')
                ->get();
            $total = 0;
            foreach ($keranjang as $value) {
                $total += $value->harga * $value->jumlah;
            }
            //return $total;
            //return $keranjang;
            $transaksi = new Transaksi();
            $transaksi->users_id = Auth::user()->id;
            $transaksi->total = $total;
            $transaksi->toko_users_id = $request->get('idtoko');
            $transaksi->alamat_idalamat = $request->get('alamat');
            $transaksi->pengiriman = $request->get('pengiriman');
            $transaksi->pembayaran = $request->get('pembayaran');
            $transaksi->save();
            $transaksi->idtransaksi;

            foreach ($keranjang as $value) {
                DB::table('transaksi_has_produk')->insert([
                    'transaksi_idtransaksi' => $transaksi->idtransaksi,
                    'produk_idproduk' => $value->idproduk,
                    'jumlah' => $value->jumlah * $value->harga,
                    'qty' => $value->jumlah
                ]);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }
    }
}
