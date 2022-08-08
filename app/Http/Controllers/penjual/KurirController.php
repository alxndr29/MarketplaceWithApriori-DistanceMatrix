<?php

namespace App\Http\Controllers\penjual;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Kurir;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class KurirController extends Controller
{
    //
    public function index()
    {
        $kurir = Kurir::where('toko_users_id', Auth::user()->id)->get();
        return view(
            'penjual.kurir',
            compact('kurir')
        );
    }
    public function store(Request $request)
    {
        try {
            $kurir = new Kurir();
            $kurir->nama = $request->get('nama');
            $kurir->email = $request->get('email');
            $kurir->password =  Hash::make($request->get('password'));
            $kurir->toko_users_id = Auth::user()->id;
            $kurir->save();
            return redirect()->back()->with('sukses', 'Berhasil menambah kurir baru');
        } catch (\Exception $e) {
            return redirect()->back()->with('gagal', $e->getMessage());
        }
    }
    public function update(Request $request, $id)
    {
        try {
            $kurir = Kurir::find($id);
            $kurir->nama = $request->get('nama');
            $kurir->email = $request->get('email');
            if ($request->get('password')) {
                $kurir->password = $request->get('password');
            }
            $kurir->save();
            return redirect()->back()->with('sukses', 'Berhasil ubah kurir');
        } catch (\Exception $e) {
            return redirect()->back()->with('gagal', $e->getMessage());
        }
    }
    public function destroy($id)
    {
        try {
            $kurir = Kurir::find($id);
            $kurir->delete();
            return redirect()->back()->with('sukses', 'Berhasil hapus kurir');
        } catch (\Exception $e) {
            return redirect()->back()->with('gagal', $e->getMessage());
        }
    }
}
