<?php

namespace App\Http\Controllers;

class InvoiceController extends Controller
{
    public function index()
    {
        $data['title'] = 'Invoice';
        $data['active'] = ['invoice'];
        $data['breadCrumb'] = ['Invoice', 'Data'];

        return view('invoice.index', $data);
    }
}
