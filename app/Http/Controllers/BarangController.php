<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index(){
        $data['title'] = 'Data Barang';
        $data['active'] = ['data-master', 'barang'];
        $data['breadCrumb'] = ['Barang', 'Data'];

        return view('barang.index', $data);
    }

    public function detail($id){
        $barang = Barang::find($id);
        if(!$barang){
            return redirect()->back()->with('fail', "Barang tidak ditemukan");
        }
        $data['title'] = 'Detail Barang';
        $data['active'] = ['data-master', 'barang'];
        $data['breadCrumb'] = ['Barang', 'Data', 'Detail'];
        $data['barang'] = $barang;

        return view('barang.detail', $data);
    }
}
