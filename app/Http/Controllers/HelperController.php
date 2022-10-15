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

    function format_num ($input, $pad_len = 7, $prefix = null) {
        if ($pad_len <= strlen($input))
            trigger_error('<strong>$pad_len</strong> cannot be less than or equal to the length of <strong>$input</strong> to generate invoice number', E_USER_ERROR);

        if (is_string($prefix))
            return sprintf("%s%s", $prefix, str_pad($input, $pad_len, "0", STR_PAD_LEFT));

        return str_pad($input, $pad_len, "0", STR_PAD_LEFT);
    }

    function format_romawi($number){
        if($number > 12){
            return "Inputan tidak boleh lebih dari 12";
        }

        switch ($number){

            case 1:

                return "I";

                break;

            case 2:

                return "II";

                break;

            case 3:

                return "III";

                break;

            case 4:

                return "IV";

                break;

            case 5:

                return "V";

                break;

            case 6:

                return "VI";

                break;

            case 7:

                return "VII";

                break;

            case 8:

                return "VIII";

                break;

            case 9:

                return "IX";

                break;

            case 10:

                return "X";

                break;

            case 11:

                return "XI";

                break;

            case 12:

                return "XII";

                break;

            default:
                return "Inputan tidak valid !";
                break;
      }
    }
}
