<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $data['title'] = 'Dashboard Admin | ERP';
        $data['active'] = ['data-master','dashboard'];
        $data['breadCrumb'] = ['Dashbord', 'Data'];
        return view('dashboard.index', $data);
    }
}
