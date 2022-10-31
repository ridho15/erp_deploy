<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MetodePembayaranController extends Controller
{
    public function index(){
        $data['title'] = 'Metode Pembayaran';
        $data['active'] = ['data-master', 'metode-pembayaran'];
        $data['breadCrumb'] = ['Data Master', 'Metode Pembayaran'];

        return view('metode-pembayaran.index', $data);
    }
}
