<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class QuotationController extends Controller
{
    public function index(){
        $data['title'] = "Quotation";
        $data['active'] = ['quotation'];
        $data['breadCrumb'] = ['Quotation', 'Data'];

        return view('quotation.index', $data);
    }
}
