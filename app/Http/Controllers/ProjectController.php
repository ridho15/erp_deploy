<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(){
        $data['title'] = "Project";
        $data['active'] = ['data-master', 'project'];
        $data['breadCrumb'] = ['Project', 'Data'];

        return view('project.index', $data);
    }
}
