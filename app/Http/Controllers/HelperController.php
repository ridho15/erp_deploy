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

    public function getListStatusOrder(){
        return collect([
            collect([
                'status_order' => '1',
                'keterangan' => 'Sedang Diajukan'
            ]),
            collect([
                'status_order' => '2',
                'keterangan' => 'Sedang Diproses'
            ]),
            collect([
                'status_order' => '3',
                'keterangan' => 'Dalam Pengiriman'
            ]),
            collect([
                'status_order' => '4',
                'keterangan' => 'Selesai'
            ]),
            collect([
                'status_order' => '0',
                'keterangan' => 'Dibatalkan / Ditolak'
            ]),
        ]);
    }
}
