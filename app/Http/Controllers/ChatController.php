<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class ChatController extends Controller
{
    //
    public function indexPembeli(){
        return view('pembeli.chat');
    }
    public function indexPenjual(){

    }
    public function ambilDataPenjual(){

    }
    public function ambilDataPembeli(){

    }
    public function storeDataPenjual(){

    }
    public function storeDataPembeli(){
        
    }
}
