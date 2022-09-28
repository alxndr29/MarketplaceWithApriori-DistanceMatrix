<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Chat;
class ChatController extends Controller
{
    //
    public function indexPembeli(){
        $data = Chat::where('idpembeli',Auth::user()->id)
        ->select('idpenjual')
        ->groupBy('idpenjual')
        ->get();
        return view('pembeli.chat',compact('data'));
    }
    public function indexPenjual(){
        $data = Chat::where('idpenjual',Auth::user()->id)
        ->select('idpembeli')
        ->groupBy('idpenjual')
        ->get();
        return view('pembeli.chat',compact('data'));
    }
    public function ambilDataPenjual(){
        try{
            $data = Chat::where('idpembeli', Auth::user()->id)
                ->get();
            return response()->json([
                'data' => $data
            ]);
        }catch(\Exception $e){
            return response()->json([
                'data' => $e->getMessage()
            ]);
        }
        
    }
    public function ambilDataPembeli(){
        try{
            $data = Chat::where('idpenjual', Auth::user()->id)
                ->get();
            return response()->json([
                'data' => $data
            ]);
        }catch(\Exception $e){
            return response()->json([
                'data' => $e->getMessage()
            ]);
        }
        
    }
    public function storeDataPenjual(Request $request){
        try{
            $chat = new Chat();
            $chat->pesan = $request->get('pesan');
            $chat->idpenjual = Auth::user()->id;
            $chat->idpembeli = $request->get('idpembeli');
            $chat->pengirim = "penjual";
            return response()->json([
                'data' => 'berhasil'
            ]);
        }catch(\Exception $e){
            return response()->json([
                'data' => $e->getMessage()
            ]);
        }
    }
    public function storeDataPembeli(Request $request){
        try{

            $chat = new Chat();
            $chat->pesan = $request->get('pesan');
            $chat->idpembeli = Auth::user()->id;
            $chat->idpenjual = $request->get('idpenjual');
            $chat->pengirim = "pembeli";
            $chat->save();

            return response()->json([
                'data' => 'berhasil'
            ]);
        }catch(\Exception $e){
            return response()->json([
                'data' => $e->getMessage()
            ]);
        }
    }
}
