<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function accountPayable(){
        $data['title'] = "Laporan Account Payable";
        $data['active'] = ['laporan', 'laporan-account-payable'];
        $data['breadCrumb'] = ['Laporan', 'Account Payable'];

        return view('laporan.account-payable', $data);
    }

    public function accountReceivable(){
        $data['title'] = "Laporan Account Receivable";
        $data['active'] = ['laporan', 'laporan-account-receivable'];
        $data['breadCrumb'] = ['Laporan', 'Account Receivable'];

        return view('laporan.account-receivable', $data);
    }

    public function kalender(){
        $data['title'] = "Kalender";
        $data['active'] = ['laporan', 'kalender'];
        $data['breadCrumb'] = ['Laporan', 'Kalender'];

        return view('laporan.kalender', $data);
    }

    public function spareparts(){
        $data['title'] = "Laporan Spareparts";
        $data['active'] = ['laporan', 'spareparts'];
        $data['breadCrumb'] = ['Laporan', 'Spareparts'];
        $listBarang = Barang::get();

        $data['listBarang'] = $listBarang;

        return view('laporan.spareparts', $data);
    }

    public function stockOpname(){
        $data['title'] = "Laporan Stock Opname Miss";
        $data['active'] = ['laporan', 'stock-opname-miss'];
        $data['breadCrumb'] = ['Laporan', 'Stock Opname Miss'];

        return view('laporan.stock-opname-miss', $data);
    }

    public function logActivity(){
        $data['title'] = 'Laporan log activity';
        $data['active'] = ['laporan', 'log-activity'];
        $data['breadCrumb'] = ['Laporan', 'Log Activity'];

        return view('laporan.log-activity', $data);
    }

    public function grafikPenjualan(){
        $data['title'] = "Grafik Penjualan";
        $data['active'] = ['laporan', 'grafik-penjualan'];
        $data['breadCrumb'] = ['Laporan', 'Grafik Penjualan'];

        return view('laporan.grafik-penjualan', $data);
    }
}
