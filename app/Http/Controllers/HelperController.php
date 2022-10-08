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

    public function getListStatusBarang(){
        return collect([
            collect([
                'status_barang' => 1,
                'keterangan' => 'Dipinjam'
            ]),
            collect([
                'status_barang' => 2,
                'keterangan' => 'Diminta'
            ]),
        ]);
    }

    public function getListStatusOrder(){
        return collect([
            collect([
                'status_order' => '1',
                'keterangan' => 'Sedang Diajukan',
                'badge' => "<span class='badge badge-primary'>Sedang Diajukan</span>"
            ]),
            collect([
                'status_order' => '2',
                'keterangan' => 'Sedang Diproses',
                'badge' => "<span class='badge badge-warning'>Sedang Diproses</span>"
            ]),
            collect([
                'status_order' => '3',
                'keterangan' => 'Dalam Pengiriman',
                'badge' => "<span class='badge badge-warning'>Dalam Pengiriman</span>"
            ]),
            collect([
                'status_order' => '4',
                'keterangan' => 'Selesai',
                'badge' => "<span class='badge badge-success'>Selesai</span>"
            ]),
            collect([
                'status_order' => '0',
                'keterangan' => 'Dibatalkan / Ditolak',
                'badge' => "<span class='badge badge-danger'>Dibatalkan / Ditolak</span>"
            ]),
        ]);
    }

    public function getListStatusResponse(){
        return collect([
            collect([
                'status_response' => '1',
                'keterangan' => "Sudah diresponse",
                'badge' => "<span class='badge badge-success'>Sudah diresponse</span>"
            ]),collect([
                'status_response' => '2',
                'keterangan' => "Belum diresponse",
                'badge' => "<span class='badge badge-secondary'>Belum diproses</span>"
            ]),collect([
                'status_response' => '0',
                'keterangan' => "Belum dikirim",
                'badge' => "<span class='badge badge-warning'>Belum dikirim</span>"
            ]),collect([
                'status_response' => '3',
                'keterangan' => "Tidak diresponse",
                'badge' => "<span class='badge badge-danger'>Tidak diresponse</span>"
            ])
            ]);
    }
}
