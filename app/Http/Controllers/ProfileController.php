<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function show()
    {
        $user = DB::table('tabel_user')
            ->orderBy('id_user', 'desc')
            ->first();

        return view('profile', compact('user'));
    }
}
