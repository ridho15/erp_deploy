<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelperController extends Controller
{
    public function getListTipeBarang(){
        return collect([
            collect([
                'tipe_barang' => 1,
                'keterangan' => 'Bisa Dipinjam'
            ]),collect([
                'tipe_barang' => 2,
                'keterangan' => 'Bisa Dibeli'
            ]),collect([
                'tipe_barang' => 3,
                'keterangan' => 'Bisa Dipinjam atau Dibeli'
            ]),
        ]);
    }
}
