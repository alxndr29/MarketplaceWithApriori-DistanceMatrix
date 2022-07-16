<?php

namespace App\Http\Controllers\pembeli;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    //
    public function index()
    {
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
                'order_id' => 2012,
                'gross_amount' => 20000,
            ),
            'customer_details' => array(
                'first_name' => 'Alexander',
                'email' => 'alexevan2810@gmail.com',
                'phone' => '08111222333',
            ),
        );
        $snapToken = \Midtrans\Snap::getSnapToken($params);
        return view('midtrans', compact('snapToken'));
    }
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
        }
    }
}
