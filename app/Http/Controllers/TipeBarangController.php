<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TipeBarangController extends Controller
{
    public function index(){
        $data['title'] = "Tipe Barang";
        $data['active'] = ['data-master', 'tipe-barang'];
        $data['breadCrumb'] = ['Tipe Barang', 'Data'];

        return view('tipe-barang.index', $data);
    }
}
