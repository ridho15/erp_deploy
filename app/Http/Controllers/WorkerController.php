<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WorkerController extends Controller
{
    public function index(){
        $data['title'] = "Worker";
        $data['active'] = ['data-master', 'worker'];
        $data['breadCrumb'] = ['Worker', 'Data'];

        return view('worker.index', $data);
    }

    public function detail(){
        $data['title'] = "Worker Detail";
        $data['active'] = ['data-master','worker'];
        $data['breadCrumb'] = ['Worker', 'Data', 'Detail'];

        return view('worker.detail', $data);
    }
}
