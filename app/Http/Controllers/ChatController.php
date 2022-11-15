<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Chat;

class ChatController extends Controller
{
    //
    public function indexPembeli($idpenjual = null)
    {
        // return $idpenjual;
        if ($idpenjual != null) {
            $data = Chat::where('idpembeli', Auth::user()->id)
                ->join('toko', 'toko.users_id', '=', 'chat.idpenjual')
                ->select('chat.idpenjual', 'toko.nama_toko')
                ->groupBy('chat.idpenjual')
                ->get();
            return view('pembeli.chat', compact('data', 'idpenjual'));
        } else {
            $data = Chat::where('idpembeli', Auth::user()->id)
                ->join('toko', 'toko.users_id', '=', 'chat.idpenjual')
                ->select('chat.idpenjual', 'toko.nama_toko')
                ->groupBy('chat.idpenjual')
                ->get();
            // return $data;
            return view('pembeli.chat', compact('data', 'idpenjual'));
        }
    }
    public function indexPenjual($idpembeli = null)
    {
        if ($idpembeli != null) {
            $data = Chat::where('idpenjual', Auth::user()->id)
                ->join('users', 'users.id', '=', 'chat.idpembeli')
                ->select('chat.idpembeli', 'users.name')
                ->groupBy('chat.idpembeli')
                ->get();
            // return $data;
            return view('penjual.chat', compact('data', 'idpembeli'));
        } else {
            $data = Chat::where('idpenjual', Auth::user()->id)
                ->join('users', 'users.id', '=', 'chat.idpembeli')
                ->select('chat.idpembeli', 'users.name')
                ->groupBy('chat.idpembeli')
                ->get();
            return view('penjual.chat', compact('data', 'idpembeli'));
        }
    }
    public function ambilDataPenjual($id)
    {
        try {
            $data = Chat::where('idpembeli', $id)
                ->where('idpenjual', Auth::user()->id)
                ->join('users', 'users.id', '=', 'chat.idpembeli')
                ->join('toko', 'toko.users_id', '=', 'chat.idpenjual')
                ->select('chat.*', 'toko.nama_toko', 'users.name')
                ->get();
            return response()->json([
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'data' => $e->getMessage()
            ]);
        }
    }
    public function ambilDataPembeli($id)
    {
        // return 'a';
        try {
            $data = Chat::where('idpenjual', $id)
                ->where('idpembeli', Auth::user()->id)
                ->join('users', 'users.id', '=', 'chat.idpembeli')
                ->join('toko', 'toko.users_id', '=', 'chat.idpenjual')
                ->select('chat.*', 'toko.nama_toko', 'users.name')
                ->get();
            return response()->json([
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'data' => $e->getMessage()
            ]);
        }
    }
    public function storeDataPenjual(Request $request)
    {
        try {
            $chat = new Chat();
            $chat->pesan = $request->get('pesan');
            $chat->idpenjual = Auth::user()->id;
            $chat->idpembeli = $request->get('idpembeli');
            $chat->pengirim = "penjual";
            $chat->save();
            return response()->json([
                'data' => 'berhasil'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'data' => $e->getMessage()
            ]);
        }
    }
    public function storeDataPembeli(Request $request)
    {
        try {

            $chat = new Chat();
            $chat->pesan = $request->get('pesan');
            $chat->idpembeli = Auth::user()->id;
            $chat->idpenjual = $request->get('idpenjual');
            $chat->pengirim = "pembeli";
            $chat->save();

            return response()->json([
                'data' => 'berhasil'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'data' => $e->getMessage()
            ]);
        }
    }
}
