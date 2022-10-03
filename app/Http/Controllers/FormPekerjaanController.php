<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormPekerjaanController extends Controller
{
    public function index(){
        $data['title'] = 'Form Pekerjaan';
        $data['active'] = ['form-pekerjaan'];
        $data['breadCrumb'] = ['Form Pekerjaan Data'];

        return view('form-pekerjaan.index', $data);
    }
}
