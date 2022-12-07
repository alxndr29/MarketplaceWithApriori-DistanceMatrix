<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Refund;
use App\Transaksi;

class AdminController extends Controller
{
    //
    public function login(Request $request)
    {
        // return  $request->session()->get('admin');
        if ($request->session()->has('admin')) {
            return redirect('admin');
        } else {
            return view('admin.login');
        }
    }
    public function logout(Request $request){
        if ($request->session()->has('admin')) {
            $request->session()->forget('admin');
            return view('admin.login');
        } else {
            return view('admin.login');
        }
    }
    public function loginproses(Request $request)
    {
        try {
            if ($request->get('email') == "admin@admin.com" && $request->get('password') == "123") {
                $request->session()->put('admin', 1);
                return redirect('admin');
            } else {
                return 'username password salah';
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    public function index(Request $request)
    {

        if ($request->session()->has('admin')) {
            return view('admin.index');
        } else {
            return view('admin.login');
        }
        
    }
    public function onkir(Request $request)
    {
        if ($request->session()->has('admin')) {
            $data = DB::table('konfigurasi')->first();
            return view('admin.onkir', compact('data'));
        } else {
            return view('admin.login');
        }
        
    }
    public function setOnkir(Request $request)
    {
        try {
            DB::table('konfigurasi')->update(['harga_ongkir' => $request->get('harga_ongkir')]);
            return back()->with('sukses', 'BErhasil ubah.');
        } catch (\Exception $e) {
            return back()->with('gagal', $e->getMessage());
        }
        return view('admin.onkir', compact('data'));
    }
    public function refund(Request $request)
    {
        if ($request->session()->has('admin')) {
            $daftar_refund = Refund::where('pemohon', 'pembeli')->get();
            return view('admin.refund', compact('daftar_refund'));
        } else {
            return view('admin.login');
        }
        
       
    }
    public function pencairan(Request $request)
    {
        if ($request->session()->has('admin')) {
            $daftar_pencairan = Refund::where('pemohon', 'penjual')->get();
            return view('admin.pencarian', compact('daftar_pencairan'));
        } else {
            return view('admin.login');
        }
       
    }
    public function acc(Request $request,$id)
    {
        try {
            Refund::where('idrefund', $id)->update(['status' => 'Selesai']);
            return back()->with('sukses', 'BErhasil ubah.');
        } catch (\Exception $e) {
            return back()->with('gagal', $e->getMessage());
        }
    }
}
