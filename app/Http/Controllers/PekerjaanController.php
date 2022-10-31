<?php

namespace App\Http\Controllers;

class PekerjaanController extends Controller
{
    public function index()
    {
        $data['title'] = 'Data Pekerjaan';
        $data['active'] = ['data-master', 'Pekerjaan'];
        $data['breadCrumb'] = ['Pekerjaan', 'Data'];

        return view('pekerjaan.index', $data);
    }
}
