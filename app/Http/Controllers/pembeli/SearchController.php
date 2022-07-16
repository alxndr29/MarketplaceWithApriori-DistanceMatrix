<?php

namespace App\Http\Controllers\pembeli;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    //
    public function index(){
        return view('pembeli.search');
    }
}
