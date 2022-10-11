<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\FormMaster;
use Illuminate\Http\Request;

class FormMasterController extends Controller
{
    public function index(){
        $data['title'] = 'Form Master';
        $data['active'] = ['data-master', 'form'];
        $data['breadCrumb'] = ['Form', 'Data'];

        return view('form.index', $data);
    }

    public function detail($id){
        $formMaster = FormMaster::find($id);
        if(!$formMaster){
            $message = "Data Form tidak ditemukan";
            return redirect()->back()->with('fail', $message);
        }

        $data['title'] = "Form Master";
        $data['active'] = ['data-master', 'form'];
        $data['breadCrumb'] = ["Form", 'Data'];
        $data['formMaster'] = $formMaster;

        return view('form.detail', $data);
    }
}
