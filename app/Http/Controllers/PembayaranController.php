<?php

namespace App\Http\Controllers;

class PembayaranController extends Controller
{
    public function index()
    {
        $data['title'] = 'Tipe Pembayaran';
        $data['active'] = ['data-master', 'tipe-pembayaran'];
        $data['breadCrumb'] = ['Tipe Pembayaran', 'Data'];

        return view('master.tipePembayaran.index', $data);
    }
}
