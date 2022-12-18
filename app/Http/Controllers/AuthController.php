<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function masuk()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required|min:5'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('warning', $validator->errors()->first());
        }
        $user = User::where('username', $request->username)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                Auth::login($user);
                if (Auth::user()->role == 'super admin' || Auth::user()->role == 'admin') {
                    return redirect('/');
                } else {
                    return redirect('/dokter');
                }
            } else {
                return redirect()->back()->with('error', 'username atau password salah');
            }
        } else {
            return redirect()->back()->with('error', 'username tidak terdaftar');
        }
    }

    public function logout()
    {
        Auth::logout(); // menghapus session yang aktif
        return redirect('/auth/masuk');
    }




    public function daftar()
    {
        return view('auth.register');
    }
}