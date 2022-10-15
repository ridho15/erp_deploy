<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PreOrder;
use Illuminate\Http\Request;

class PreOrderController extends Controller
{
    public function index(){
        $data['title'] = "Pre Order";
        $data['active'] = ['pre-order'];
        $data['breadCrumb'] = ['Pre Order', 'Data'];

        return view('pre-order.index', $data);
    }

    public function detail($id){
        $preOrder = PreOrder::find($id);
        if(!$preOrder){
            return redirect()->back()->with('fail', "Data Pre Order tidak ditemukan");
        }

        $data['title'] = 'Pre Order Detail';
        $data['active'] = ['pre-order'];
        $data['breadCrumb'] = ['Pre Order', 'Data', 'Detail'];
        $data['preOrder'] = $preOrder;

        return view('pre-order.detail', $data);
    }
}
