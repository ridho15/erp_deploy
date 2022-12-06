<?php

namespace App\Http\Controllers;

use App\Models\Rak;
use Illuminate\Http\Request;

class RakController extends Controller
{
    public function index(){
        $data['title'] = 'Rak';
        $data['active'] = ['inventory','rak'];
        $data['breadCrumb'] = ['Rak', 'Data'];

        return view('rak.index', $data);
    }

    public function detail($id){
        $data['title'] = "Detail";
        $data['active'] = ['inventory','rak'];
        $data['breadCrumb'] = ['Rak', 'Detail'];

        $rak = Rak::find($id);
        $data['rak'] = $rak;

        return view('rak.detail', $data);
    }
}
