<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index(){
        $data['title'] = "Inventory";
        $data['active'] = ['inventory'];
        $data['breadCrumb'] = ['inventory', 'data'];

        return view('inventory.index', $data);
    }
}
