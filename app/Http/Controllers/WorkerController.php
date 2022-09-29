<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WorkerController extends Controller
{
    public function index(){
        $data['title'] = "Worker";
        $data['active'] = 'worker';
        $data['breadCrumb'] = ['Worker', 'Data'];

        return view('worker.index', $data);
    }
}
