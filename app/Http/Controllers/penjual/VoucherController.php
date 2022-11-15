<?php

namespace App\Http\Controllers\penjual;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Voucher;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class VoucherController extends Controller
{
    //
    public function index()
    {
        $data = Voucher::where('toko_users_id', Auth::user()->id)->get();
        return view('penjual.voucher', compact('data'));
    }
    public function store(Request $request)
    {
        try {
            $voucher = new Voucher();
            $voucher->judul = $request->get('judul');
            $voucher->potongan = $request->get('potongan');
            $voucher->expired = $request->get('expired');
            $voucher->kode_voucher = $request->get('kode_voucher');
            $voucher->toko_users_id = Auth::user()->id;
            $voucher->status = 'Aktif';
            $voucher->save();
            return redirect()->back()->with('sukses', 'Berhasil menambah voucher.');
        } catch (\Exception $e) {
            return redirect()->back()->with('gagal', $e->getMessage());
        }
    }
    public function edit(Request $request, $id)
    {
        try {
            $voucher = Voucher::find($id);
            $voucher->judul = $request->get('judul');
            $voucher->potongan = $request->get('potongan');
            $voucher->expired = $request->get('expired');
            $voucher->kode_voucher = $request->get('kode_voucher');
            $voucher->toko_users_id = Auth::user()->id;
            $voucher->save();
            return redirect()->back()->with('sukses', 'Berhasil ubah voucher.');
        } catch (\Exception $e) {
            return redirect()->back()->with('gagal', $e->getMessage());
        }
    }
    public function destroy($id)
    { 
        try{
            $voucher = Voucher::find($id);
            $voucher->status = "Tidak Aktif";
            $voucher->save();
            return redirect()->back()->with('sukses', 'Berhasil non aktifkan voucher.');
        }catch(\Exception $e){
            return redirect()->back()->with('gagal', $e->getMessage());
        }
    }
}
