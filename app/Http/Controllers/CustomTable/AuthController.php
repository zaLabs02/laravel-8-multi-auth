<?php

namespace App\Http\Controllers\CustomTable;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        if ($user = Auth::guard('customtable')->user()) {
            if ($user->level == 'QA') {
                return redirect()->intended('pegawai/dashboard/QA');
            } elseif ($user->level == 'editor') {
                return redirect()->intended('pegawai/dashboard/editor_pegawai');
            }
        }
        return view('login');
    }

    public function proses_login(Request $request)
    {
        request()->validate(
            [
                'username' => 'required',
                'password' => 'required',
            ]);

        $kredensil = $request->only('username','password');

            if (Auth::guard('customtable')->attempt($kredensil)) {
                $user = Auth::guard('customtable')->user();
                if ($user->level == 'QA') {
                    return redirect()->intended('pegawai/dashboard/QA');
                } elseif ($user->level == 'editor') {
                    return redirect()->intended('pegawai/dashboard/editor_pegawai');
                }
                return redirect()->intended('/');
            }

        return redirect()->route('login_pegawai')
                                ->withInput()
                                ->withErrors(['login_gagal' => 'These credentials do not match our records.']);
    }
}
