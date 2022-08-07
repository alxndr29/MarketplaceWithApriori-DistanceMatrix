<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MidtransController extends Controller
{
    //
    public function config()
    {
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = 'SB-Mid-server-yj9hNmncUrqOhEvf1k3JSmPX';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;
    }
    public function payment_handling(Request $request)
    {
        $this->config();
        $notif = new \Midtrans\Notification();
        $transaction = $notif->transaction_status;
        $type = $notif->payment_type;
        $order_id = $notif->order_id;
        $fraud = $notif->fraud_status;
        if ($transaction == 'capture') {
            // For credit card transaction, we need to check whether transaction is challenge by FDS or not
            if ($type == 'credit_card') {
                if ($fraud == 'challenge') {
                    // TODO set payment status in merchant's database to 'Challenge by FDS'
                    // TODO merchant should decide whether this transaction is authorized or not in MAP
                    echo "Transaction order_id: " . $order_id . " is challenged by FDS";
                } else {
                    // TODO set payment status in merchant's database to 'Success'
                    echo "Transaction order_id: " . $order_id . " successfully captured using " . $type;
                }
            }
        } else if ($transaction == 'settlement') {
            // TODO set payment status in merchant's database to 'Settlement'
            echo "Transaction order_id: " . $order_id . " successfully transfered using " . $type;
            DB::table('transaksi')->where('idtransaksi', $order_id)->update([
                'status' => "Menunggu Konfirmasi",
                'updated_at' => date("Y-m-d H:i:s")
            ]);
            DB::table('midtrans')->where('transaksi_idtransaksi', $order_id)->update([
                'status' => $transaction
            ]);
        } else if ($transaction == 'pending') {
            // TODO set payment status in merchant's database to 'Pending'
            echo "Waiting customer to finish transaction order_id: " . $order_id . " using " . $type;
            DB::table('midtrans')->where('transaksi_idtransaksi', $order_id)->update([
                'status' => $transaction,
                'updated_at' => date("Y-m-d H:i:s")
            ]);
        } else if ($transaction == 'deny') {
            // TODO set payment status in merchant's database to 'Denied'
            echo "Payment using " . $type . " for transaction order_id: " . $order_id . " is denied.";
            DB::table('midtrans')->where('transaksi_idtransaksi', $order_id)->update([
                'status' => $transaction,
                'updated_at' => date("Y-m-d H:i:s")
            ]);
        } else if ($transaction == 'expire') {
            // TODO set payment status in merchant's database to 'expire'
            echo "Payment using " . $type . " for transaction order_id: " . $order_id . " is expired.";
            DB::table('transaksi')->where('idtransaksi', $order_id)->update([
                'status' => "Batal",
                'updated_at' => date("Y-m-d H:i:s")
            ]);
            DB::table('midtrans')->where('transaksi_idtransaksi', $order_id)->update([
                'status' => $transaction
            ]);
        } else if ($transaction == 'cancel') {
            // TODO set payment status in merchant's database to 'Denied'
            echo "Payment using " . $type . " for transaction order_id: " . $order_id . " is canceled.";
            DB::table('transaksi')->where('idtransaksi', $order_id)->update([
                'status_transaksi' => "Batal",
                'updated_at' => date("Y-m-d H:i:s")
            ]);
            // $detailTransaksi = DB::table('detailtransaksi')->where('transaksi_idtransaksi', $order_id)->get();
            // foreach ($detailTransaksi as $key => $value) {
            //     $produk = Produk::find($value->produk_idproduk);
            //     if ($produk->stok == 0) {
            //         $produk->status = "Aktif";
            //     }
            //     $produk->stok = $produk->stok + $value->jumlah;
            //     $produk->save();
            // }
            DB::table('midtrans')->where('transaksi_idtransaksi', $order_id)->update([
                'status' => $transaction
            ]);
        }
    }
}
