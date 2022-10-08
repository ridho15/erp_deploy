<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\SupplierOrder;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index(){
        $data['title'] = "Data Supplier";
        $data['active'] = ['data-master', 'supplier'];
        $data['breadCrumb'] = ['Supplier', 'Data'];

        return view('supplier.index', $data);
    }

    public function detail($id){
        $supplier = Supplier::find($id);
        if(!$supplier){
            return redirect()->back()->with('fail', "Data Supplier tidak ditemukan.");
        }

        $data['title'] = "Detail Supplier";
        $data['active'] = ['data-master', 'supplier'];
        $data['breadCrumb'] = ['Supplier', 'Data', 'Detail'];
        $data['supplier'] = $supplier;

        return view('supplier.detail', $data);
    }

    public function order(){
        $data['title'] = "Data Supplier Order";
        $data['active'] = ['supplier-order'];
        $data['breadCrumb'] = ["Supplier", "Order", 'Data'];

        return view('supplier.order', $data);
    }

    public function orderDetail($id){
        $supplierOrder = SupplierOrder::find($id);
        if(!$supplierOrder){
            return redirect()->back()->with('fail', 'Supplier Order tidak ditemukan');
        }

        $data['title'] = 'Kelola Data Supplier Order';
        $data['active'] = ['supplier-order'];
        $data['breadCrumb'] = ['Supplier', 'Order', 'Data', 'Kelola'];
        $data['supplierOrder'] = $supplierOrder;
        return view('supplier.order-detail', $data);
    }
}
