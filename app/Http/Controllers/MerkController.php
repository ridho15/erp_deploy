<?php

namespace App\Http\Controllers;

use App\Models\Merk;
use Illuminate\Http\Request;
use Symfony\Component\CssSelector\Node\FunctionNode;

class MerkController extends Controller
{
    public function index(){
        $data['title'] = "Merk";
        $data['active'] = ['data-master', 'merk'];
        $data['breadCrumb'] = ['Merk', 'Data'];

        return view('merk.index', $data);
    }

    public function detail($id){
        $merk = Merk::find($id);
        if(!$merk){
            return redirect()->back()->with('fail', 'Merk tidak ditemukan');
        }

        $data['title'] = "Merk";
        $data['active'] = ['data-master', 'merk'];
        $data['breadCrumb'] = ['Merk', 'Data'];
        $data['merk'] = $merk;

        return view('merk.detail', $data);
    }
}
