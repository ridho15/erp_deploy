<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RescheduleController extends Controller
{
    public function index(){
        $data['title'] = 'Reschedule';
        $data['active'] = ['reschedule'];
        $data['breadCrumb'] = ['reschedule'];

        return view('reschedule.index', $data);
    }
}
