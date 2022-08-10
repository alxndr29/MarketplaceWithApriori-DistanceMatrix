<?php

namespace App\Http\Controllers\pembeli;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Transaksi;
use App\Produk;
use App\Midtrans;
use App\Pengiriman;

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

        $transaksi = Transaksi::where('transaksi.users_id', Auth::user()->id)
            ->leftJoin('users_has_produk', 'users_has_produk.transaksi_idtransaksi', '=', 'transaksi.idtransaksi')
            ->select('transaksi.*', DB::raw('COUNT(users_has_produk.transaksi_idtransaksi) as hitung'))
            ->get();


        // return $transaksi;
        return view('pembeli.transaksi', compact('transaksi'));
    }
    public function ambildataajax($id)
    {
        $datatransaksi = Transaksi::where('idtransaksi', $id)
            ->join('alamat', 'alamat.idalamat', '=', 'transaksi.alamat_idalamat')
            ->select('transaksi.*', 'alamat.*')
            ->first();
        $detailtransaksi = DB::table('transaksi_has_produk')
            ->where('transaksi_has_produk.transaksi_idtransaksi', $id)
            ->join('produk', 'produk.idproduk', '=', 'transaksi_has_produk.produk_idproduk')
            ->select('produk.nama', 'transaksi_has_produk.*')
            ->get();
        $datapengiriman = Pengiriman::where('transaksi_idtransaksi', $id)->leftJoin('kurir', 'kurir.idkurir', '=', 'pengiriman.kurir_idkurir')->first();

        return response()->json([
            'coba' => $id,
            'datatransaksi' => $datatransaksi,
            'detailtransaksi' => $detailtransaksi,
            'datapengiriman' => $datapengiriman
        ]);
    }
    public function store(Request $request)
    {
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
            $transaksi = new Transaksi();
            $transaksi->users_id = Auth::user()->id;
            $transaksi->total = $total;
            $transaksi->toko_users_id = $request->get('idtoko');
            $transaksi->alamat_idalamat = $request->get('alamat');
            $transaksi->pengiriman = $request->get('pengiriman');
            $transaksi->pembayaran = $request->get('pembayaran');
            if ($request->get('pembayaran') == 'transfer') {
                $transaksi->status = "Menunggu Pembayaran";
            } else {
                $transaksi->status = "Menunggu Konfirmasi";
            }
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
            if ($request->get('pengiriman') == "kurir_toko") { } else { }
            if ($request->get('pembayaran') == 'transfer') {
                // Set your Merchant Server Key
                \Midtrans\Config::$serverKey = 'SB-Mid-server-yj9hNmncUrqOhEvf1k3JSmPX';
                // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
                \Midtrans\Config::$isProduction = false;
                // Set sanitization on (default)
                \Midtrans\Config::$isSanitized = true;
                // Set 3DS transaction for credit card to true
                \Midtrans\Config::$is3ds = true;
                $params = array(
                    'transaction_details' => array(
                        'order_id' =>   $transaksi->idtransaksi,
                        'gross_amount' => $total,
                    ),
                    'customer_details' => array(
                        'first_name' => Auth::user()->id,
                        'email' => Auth::user()->email
                    ),
                );
                $snapToken = \Midtrans\Snap::getSnapToken($params);
                $midtrans = new Midtrans();
                $midtrans->token = $snapToken;
                $midtrans->transaksi_idtransaksi = $transaksi->idtransaksi;
                $midtrans->save();
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }
    }
    public function ambiltokenmidtrans($id)
    {
        $midtrans = Midtrans::where('transaksi_idtransaksi', $id)->first();
        return $midtrans->token;
    }
    public function ubahstatus($id, $status)
    {
        try {
            if ($status == "Selesai") {
                $transaksi = Transaksi::find($id);
                $transaksi->status = $status;
                $transaksi->save();
            }
            return redirect()->back()->with('sukses', 'Berhasil ubah status pesanan');
        } catch (\Exception $e) {
            return redirect()->back()->with('gagal', $e->getMessage());
        }
    }
    public function ambildatareview($id)
    {
        $review = Transaksi::where('transaksi.idtransaksi', $id)
            ->join('transaksi_has_produk', 'transaksi.idtransaksi', '=', 'transaksi_has_produk.transaksi_idtransaksi')
            ->join('produk', 'produk.idproduk', '=', 'transaksi_has_produk.produk_idproduk')
            ->select('transaksi.idtransaksi', 'produk.nama', 'produk.idproduk')
            ->where('transaksi.status', 'Selesai')
            ->get();
        return view('pembeli.review', compact('review', 'id'));
    }
    public function storereview(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            // return $request->all();
            foreach ($request->get('rating') as $key => $value) {
                DB::table('users_has_produk')->updateOrInsert([
                    'users_id' => Auth::user()->id,
                    'produk_idproduk' => $key,
                    'transaksi_idtransaksi' => $id
                ], [
                    'bintang' => $value
                ]);
            }
            foreach ($request->get('komen') as $key => $value) {
                DB::table('users_has_produk')->updateOrInsert([
                    'users_id' => Auth::user()->id,
                    'produk_idproduk' => $key,
                    'transaksi_idtransaksi' => $id
                ], [
                    'komen' => $value
                ]);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
        }
    }
}
