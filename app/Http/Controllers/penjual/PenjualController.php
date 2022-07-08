<?php

namespace App\Http\Controllers\penjual;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Toko;
use App\KotaKabupaten;

class PenjualController extends Controller
{
    //
    public function dashboard()
    {
        return view('penjual.dashboard');
    }
    public function regisToko()
    {
        return view('penjual.registrasi_toko');
    }
    public function storeToko(Request $request)
    {
        $request->validate([
            'nama_toko' => 'required|min:10'
        ]);
        try {
            $toko = new Toko();
            $toko->nama_toko = $request->get('nama_toko');
            $toko->users_id = Auth::user()->id;
            $toko->save();
            return redirect('/seller/halamanupdatetoko')->with('sukses', 'Berhasil Melakukan Registrasi Toko');
        } catch (\Exception $e) {
            return $e->getMessage();
            return back()->with('gagal', $e->getMessage());
        }
    }
    public function halamanUpdateToko()
    {
        $data = Toko::where('users_id', Auth::user()->id)->first();
        $kotakabupaten = KotaKabupaten::where('provinsi_idprovinsi',22)->get();
        return view('penjual.update_toko', compact('data','kotakabupaten'));
    }
    public function updateToko(Request $request)
    {
        // return $request->all();
        $request->validate([
            'nama_toko' => 'required',
            'deskripsi' => 'required',
            'status' => 'required'
        ]);
        try {
            Toko::where('users_id', Auth::user()->id)->update([
                'nama_toko' => $request->get('nama_toko'),
                'deskripsi' => $request->get('deskripsi'),
                'status' => $request->get('status'),
                'alamat' => $request->get('alamat'),
                'telepon' => $request->get('telepon'),
                'latitude' => $request->get('latitude'),
                'longitude' => $request->get('longitude'),
                'kotakabupaten_idkotakabupaten' => $request->get('kotakabupaten')
            ]);
            return redirect('/seller/halamanupdatetoko')->with('sukses', 'Berhasil Melakukan Update Data Toko');
        } catch (\Exception $e) {
            return $e->getMessage();
            return back()->with('gagal', $e->getMessage());
        }
    }
}
