<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class FormPekerjaanController extends Controller
{
    public function index(){
        $data['title'] = 'Form Pekerjaan';
        $data['active'] = ['form-pekerjaan'];
        $data['breadCrumb'] = ['Form Pekerjaan ','Data'];

        return view('form-pekerjaan.index', $data);
    }

    public function detail($id){
        $data['title'] = 'Form Pekerjaan';
        $data['active'] = ['form-pekerjaan'];
        $data['breadCrumb'] = ['Form Pekerjaan', 'Detail'];
        $project = Project::find($id);
        if(!$project){
            return redirect()->back()->with('fail', "Pekerjaan tidak valid !");
        }

        $data['project'] = $project;

        return view('form-pekerjaan.detail', $data);
    }
}
