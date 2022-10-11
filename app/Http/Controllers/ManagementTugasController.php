<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ManagementTugasController extends Controller
{
    public function index(){
        $data['title'] = "Management Tugas";
        $data['active'] = ['management-tugas'];
        $data['breadCrumb'] = ['Management Tugas', 'Data'];

        return view('management-tugas.index', $data);
    }
}
