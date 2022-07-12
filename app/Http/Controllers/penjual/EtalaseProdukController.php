<?php

namespace App\Http\Controllers\penjual;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\EtalaseProduk;

class EtalaseProdukController extends Controller
{
    //
    public function index()
    {
        $etalase = EtalaseProduk::where('toko_users_id',Auth::user()->id)->get();
        return view('penjual.etalase', compact('etalase'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required'
        ]);
        try {
            $etalase = new EtalaseProduk();
            $etalase->nama = $request->get('nama');
            $etalase->toko_users_id = Auth::user()->id;
            $etalase->save();
            return redirect()->back()->with('sukses', 'Berhasil menambah etalase baru');
        } catch (\Exception $e) {
            return redirect()->back()->with('gagal', $e->getMessage());
        }
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required'
        ]);
        try {
            EtalaseProduk::where('idetalase_produk', $id)->update([
                'nama' => $request->get('nama')
            ]);
            return redirect()->back()->with('sukses', 'Berhasil menambah etalase baru');
        } catch (\Exception $e) {
            return redirect()->back()->with('gagal', $e->getMessage());
        }
    }
    public function delete($id)
    { 
        try{
            $etalase = EtalaseProduk::find($id);
            $etalase->delete();
            return redirect()->back()->with('sukses', 'Berhasil meghapus etalase ');
        }catch(\Exception $e){
            return redirect()->back()->with('gagal', $e->getMessage());
        }
    }
}
