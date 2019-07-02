<?php

namespace App\Http\Middleware;

use Closure;
use App\Permission;
use Auth;

class getAkses
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $modul_id)
    {
        $cek = Permission::where('modul_id', $modul_id)
                ->where('group_id', Auth::user()->group_id)->first();

        if ( $cek == "" ) {
            if ( $modul_id == 1) {
                return "<script language='javascript'>
                        alert('Anda Tidak Memiliki Akses');
                        document.location='".asset('/')."';
                        </script>";
            } else if ( $modul_id == 2 ) {
                return 'FALSE';
            }
        }
        return $next($request);
    }
}
