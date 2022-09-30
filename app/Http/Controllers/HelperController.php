<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelperController extends Controller
{
    public function getListBarang(){
        return [
            [
                'tipe_barang' => 1,
                'keterangan' => 'Bisa Dipinjam'
            ],[
                'tipe_barang' => 2,
                'keterangan' => 'Bisa Dibeli'
            ],[
                'tipe_barang' => 1,
                'keterangan' => 'Bisa Dipinjam atau Dibeli'
            ],
        ];
    }
}
