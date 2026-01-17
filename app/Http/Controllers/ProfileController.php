<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function show()
    {
        //AMBIL ROLE
        $role = session('role');

        //JIKA ADMIN
        if ($role === 'admin') {
            $user = (object) [
                'nama'  => session('nama'),
                'email' => 'admin@gmail.com',
                'no_hp' => '-',
                'role'  => 'admin',
            ];

            return view('profile', compact('user'));
        }

        //JIKA USER
        $user = DB::table('tabel_user')
            ->where('nama', session('nama'))
            ->first();

        if (!$user) {
            abort(404, 'User tidak ditemukan');
        }

        $user->role = 'user';

        return view('profile', compact('user'));
    }
}