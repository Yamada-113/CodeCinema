<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function viewregister()
    {
        return view('register');
    }

    public function viewLogin()
    {
        return view('login');
    }

    public function register(Request $request) {

         DB::table('tabel_user')->insert([
            'nama' => $request->nama,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'no_hp'     => $request->no_hp,
        ]);
    
        return redirect('/login')->with('success', 'Registrasi berhasil, silakan login.');
    }

    public function login(Request $request) {

        if (//Sang atmin mimin
            $request->email === 'admin@gmail.com' &&
            $request->password === 'admin123'
        ) {
            session([
                'login' => true,
                'role'  => 'admin',
                'nama'  => 'Administrator',
            ]);

            return redirect('/Admin/homeAdmin');
        }

        $request->validate([//Sang user
        'email'    => 'required|email',
        'password' => 'required',
        ]);

        $user = DB::table('tabel_user')->where('email', $request->email)->first();
        
        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->withErrors(['login' => 'Email atau password salah'])->withInput();
        }
    
        return redirect('/home');
    }
}
