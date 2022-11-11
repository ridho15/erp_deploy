<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BarangCustomerController extends Controller
{
    public function index(){
        $data['title'] = 'Barang Customer';
        $data['active'] = ['data-master','barang-customer'];
        $data['breadCrumb'] = ['Data Master', 'Barang Customer'];

        return view('barang-customer.index', $data);
    }
}
