<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\SupplierOrder;

class SupplierController extends Controller
{
    public function index()
    {
        $data['title'] = 'Data Supplier';
        $data['active'] = ['data-master', 'supplier'];
        $data['breadCrumb'] = ['Supplier', 'Data'];

        return view('supplier.index', $data);
    }

    public function detail($id)
    {
        $supplier = Supplier::find($id);
        if (!$supplier) {
            return redirect()->back()->with('fail', 'Data Supplier tidak ditemukan.');
        }

        $data['title'] = 'Detail Supplier';
        $data['active'] = ['data-master', 'supplier'];
        $data['breadCrumb'] = ['Supplier', 'Data', 'Detail'];
        $data['supplier'] = $supplier;

        return view('supplier.detail', $data);
    }

    public function order()
    {
        $data['title'] = 'Data Supplier Order';
        $data['active'] = ['purchase-order','supplier-order'];
        $data['breadCrumb'] = ['Supplier', 'Order', 'Data'];

        return view('supplier.order', $data);
    }

    public function orderDetail($id)
    {
        $supplierOrder = SupplierOrder::find($id);
        if (!$supplierOrder) {
            return redirect()->back()->with('fail', 'Supplier Order tidak ditemukan');
        }

        $data['title'] = 'Kelola Data Supplier Order';

        $data['breadCrumb'] = ['Supplier', 'Order', 'Data', 'Kelola'];
        $data['supplierOrder'] = $supplierOrder;

        if($supplierOrder->status_pembayaran != 2){
            $data['active'] = ['accounts','payable'];
        }else{
            $data['active'] = ['supplier-order'];
        }

        return view('supplier.order-detail', $data);
    }

    public function payable(){
        $data['title'] = "Kelola Pembayaran Supplier Order";
        $data['active'] = ['accounts', 'payable'];
        $data['breadCrumb'] = ['Supplier', 'Order', 'Payable'];

        return view('supplier.order-payable', $data);
    }
}
