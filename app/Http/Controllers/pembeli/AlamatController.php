<?php

namespace App\Http\Controllers\pembeli;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Alamat;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Provinsi;
use App\KotaKabupaten;

class AlamatController extends Controller
{
    //
    public function index()
    {
        $provinsi = Provinsi::all();
        $kotakabupaten = KotaKabupaten::all();
        $data = Alamat::where('users_id', Auth::user()->id)->get();
        return view('pembeli.alamat', compact('provinsi', 'kotakabupaten', 'data'));
    }
    public function store(Request $request)
    {
        try {
            $alamat = new Alamat();
            $alamat->alamat_lengkap = $request->get('alamat_lengkap');
            $alamat->nama_penerima = $request->get('nama_penerima');
            $alamat->latitude = $request->get('latitude');
            $alamat->longitude = $request->get('longitude');
            $alamat->telepon = $request->get('telepon');
            $alamat->provinsi_idprovinsi = $request->get('provinsi');
            $alamat->kotakabupaten_idkotakabupaten = $request->get('kotakabupaten');
            $alamat->users_id =  Auth::user()->id;
            $alamat->save();
            return redirect()->back()->with('sukses', 'Berhasil tambah alamat');
        } catch (\Exception $e) {
            return redirect()->back()->with('gagal', $e->getMessage());
        }
    }
    public function edit($id)
    {
        // return $id;
        try {
            $alamat = Alamat::where('idalamat', $id)->first();
            return response()->json([
                'data' => $alamat
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'data' => $e->getMessage()
            ]);
        }
    }
    public function update(Request $request, $id)
    {
        try {
            $alamat = Alamat::find($id);
            $alamat->alamat_lengkap = $request->get('alamat_lengkap_edit');
            $alamat->nama_penerima = $request->get('nama_penerima_edit');
            $alamat->latitude = $request->get('latitude_edit');
            $alamat->longitude = $request->get('longitude_edit');
            $alamat->telepon = $request->get('telepon_edit');
            $alamat->provinsi_idprovinsi = $request->get('provinsi_edit');
            $alamat->kotakabupaten_idkotakabupaten = $request->get('kotakabupaten_edit');
            $alamat->users_id =  Auth::user()->id;
            $alamat->save();
            return redirect()->back()->with('sukses', 'Berhasil edit alamat');
        } catch (\Exception $e) {
            return redirect()->back()->with('gagal', $e->getMessage());
        }
        return $request->all();
    }
    public function destroy($id)
    {
        try {
            Alamat::where('users_id', Auth::user()->id)->where('idalamat', $id)->delete();
            return redirect()->back()->with('sukses', 'Berhasil hapus alamat');
        } catch (\Exception $e) {
            return redirect()->back()->with('gagal', $e->getMessage());
        }
    }
    public function jadikanUtama($id)
    {
        try {
            Alamat::where('users_id', Auth::user()->id)->update(['default' => 0]);
            Alamat::where('users_id', Auth::user()->id)->where('idalamat',$id)->update(['default' => 1]);
            return redirect()->back()->with('sukses', 'Berhasil Ubah Alamat Utama');
        } catch (\Exception $e) {
            return redirect()->back()->with('gagal', $e->getMessage());
        }
    }
}
