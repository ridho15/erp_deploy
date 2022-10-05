<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index(){
        $data['title'] = "Kategori Barang";
        $data['active'] = ['data-master', 'kategori'];
        $data['breadCrumb'] = ['Kategori Barang', 'Data'];

        return view('kategori.index', $data);
    }

    public function detail($id){
        $kategori = Kategori::find($id);
        if(!$kategori){
            return redirect()->back()->with('fail', 'Kategori barang tidak ditemukan');
        }

        $data['title'] = 'Kategori Barang';
        $data['active'] = ['data-master', 'kategori'];
        $data['breadCrumb'] = ['Kategori Barang', 'Data'];

        return view('kategori.detail', $data);
    }
}
