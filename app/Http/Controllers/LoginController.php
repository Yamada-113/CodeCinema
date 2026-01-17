<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    /* ================= LOGIN & REGISTER ================= */

    public function viewRegister()
    {
        return view('register');
    }

    public function viewLogin()
    {
        return view('login');
    }

    public function register(Request $request)
    {
        DB::table('tabel_user')->insert([
            'nama'     => $request->nama,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'no_hp'    => $request->no_hp,
        ]);

        return redirect('/login')->with('success', 'Registrasi berhasil');
    }

    public function login(Request $request)
    {
        // admin hardcode
        if ($request->email === 'admin@gmail.com' && $request->password === 'admin123') {
            session([
                'login' => true,
                'role'  => 'admin',
                'nama'  => 'Administrator',
            ]);
            return redirect()->route('admin.home');
        }

        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $user = DB::table('tabel_user')->where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->withErrors(['login' => 'Email atau password salah']);
        }

        session([
            'login' => true,
            'role'  => 'user',
            'nama'  => $user->nama,
        ]);

        return redirect('/home');
    }

    /* ================= FORGOT PASSWORD ================= */

    // FORM FORGOT PASSWORD
    public function forgotPasswordForm()
    {
        return view('forgot-password');
    }

    // Simpan password baru
    public function resetPassword(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email|exists:tabel_user,email',
            'password' => 'required|confirmed',
        ], [
            'email.exists' => 'Email tidak terdaftar',
            'password.confirmed' => 'Password konfirmasi tidak cocok'
        ]);

        // Update password di tabel_user
        DB::table('tabel_user')
            ->where('email', $request->email)
            ->update([
                'password' => Hash::make($request->password)
            ]);

        return redirect('/login')->with('success', 'Password berhasil diubah');
    }
}