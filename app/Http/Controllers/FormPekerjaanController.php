<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectDetail;
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

    public function detailPekerjaan($id){
        $data['title'] = "Pekerjaan Detail";
        $data['active'] = ['form-pekerjaan', 'Detail Pekerjaan'];
        $data['breadCrumb'] = ['Form Pekerjaan', 'Detail Pekerjaan'];

        $projectDetail = ProjectDetail::find($id);
        if(!$projectDetail){
            return redirect()->back()->with('fail', "Pekerjaan tidak ditemukan !");
        }

        $data['projectDetail'] = $projectDetail;
        return view('form-pekerjaan.detail-pekerjaan', $data);
    }
}

