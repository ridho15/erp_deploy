<?php

namespace App\Http\Controllers;

class ProfileController extends Controller
{
    public function edit()
    {
        $data['title'] = 'Ubah Profil Pengguna';
        $data['active'] = [];

        return view('profil.index', $data);
    }
}
