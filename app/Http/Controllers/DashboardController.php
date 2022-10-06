<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function index()
    {
        $data['title'] = 'Dashboard Admin | ERP';
        $data['active'] = ['dashboard'];
        $data['breadCrumb'] = ['Dashbord', 'Data'];

        return view('dashboard.index', $data);
    }
}
