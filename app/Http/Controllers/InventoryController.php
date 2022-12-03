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

    public function stockOpname(){
        $data['title'] = "Stock Opname";
        $data['active'] = ['inventory', 'stock-opname'];
        $data['breadCrumb'] = ['Inventory', 'Stock Opname'];

        return view('inventory.stock-opname', $data);
    }
}
