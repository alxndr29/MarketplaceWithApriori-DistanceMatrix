<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Toko;

class CekToko
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // $result = DB::table('toko')->where('users_id', Auth::user()->id)->first();
        $result = Toko::where('users_id', Auth::user()->id)->first();
        if ($result == null) {
            abort(403, 'Unauthorized action.');
        }
        return $next($request);
    }
}
