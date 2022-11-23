<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PinjamMeminjamController extends Controller
{
    public function index(){
        $data['title'] = "Pinjam Meminjam";
        $data['active'] = ['pinjam-meminjam'];
        $data['breadCrumb'] = ['Pinjam Meminjam', 'Data'];

        return view('pinjam-meminjam.index', $data);
    }
}
