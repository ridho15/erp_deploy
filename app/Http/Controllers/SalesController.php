<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SalesController extends Controller
{
    public function index(){
        $data['title'] = 'Sales';
        $data['active'] = ['data-master','sales'];
        $data['breadCrumb'] = ['Data Master', 'Sales'];

        return view('sales.index', $data);
    }
}
