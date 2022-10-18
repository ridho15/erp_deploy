<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index(){
        $data['title'] = "Inventory";
        $data['active'] = ['inventory'];
        $data['breadCrumb'] = ['Inventory', 'Data'];

        return view('inventory.index', $data);
    }
}
