<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Cek_login
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        $pgw = Auth::guard('customtable')->user();

        if ($pgw->level == "QA" || $pgw->level == "editor") {
            if (!Auth::guard('customtable')->check()) {
                return redirect('login');
            }
            if ($pgw->level == $role) {
                return $next($request);
            }

            return redirect()->route('login_pegawai')->with('error',"Kamu gak punya akses yaaa..");
        }

        if (!Auth::check()) {
            return redirect('login');
        }

        $user = Auth::user();

        if ($user->level == $role) {
            return $next($request);
        }
        return redirect('login')->with('error',"Kamu gak punya akses yaaa..");
        //
    }
}
