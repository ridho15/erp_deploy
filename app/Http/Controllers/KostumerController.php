<?php

namespace App\Http\Controllers;

use App\Models\Kostumer;
use Illuminate\Http\Request;

class KostumerController extends Controller
{
    public function index(){
        $data['title'] = 'Detail Costumer';
        $data['active'] = ['data-master', 'kostumer'];
        $data['breadCrumb'] = ['Costumers', 'Data', 'Detail'];

        return view('kostumer.index', $data);
    }

    public function detail($id){
        $kostumer = Kostumer::find($id);
        if(!$kostumer){
            return redirect()->back()->with('fail', 'Data Costumer tidak ditemukan !');
        }

        $data['title'] = 'Detail Costumer';
        $data['active'] = ['data-master', 'kostumer'];
        $data['breadCrumb'] = ['Costumers', 'Data', 'Detail'];
        $data['kostumer'] = $kostumer;

        return view('kostumer.detail', $data);
    }
}
