<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KondisiController extends Controller
{
    public function index(){
        $data['title'] = "Data Kondisi";
        $data['active'] = ['data-master', 'kondisi'];
        $data['breadCrumb'] = ['Kondisi', 'Data'];

        return view('kondisi.index', $data);
    }
}
