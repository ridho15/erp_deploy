<?php

namespace App\Http\Controllers;

use App\Models\CustomerOrder;
use App\Models\Kostumer;

class KostumerController extends Controller
{
    public function index()
    {
        $data['title'] = 'Detail Costumer';
        $data['active'] = ['data-master', 'kostumer'];
        $data['breadCrumb'] = ['Costumers', 'Data', 'Detail'];

        return view('kostumer.index', $data);
    }

    public function detail($id)
    {
        $kostumer = Kostumer::find($id);
        if (!$kostumer) {
            return redirect()->back()->with('fail', 'Data Costumer tidak ditemukan !');
        }

        $data['title'] = 'Detail Costumer';
        $data['active'] = ['data-master', 'kostumer'];
        $data['breadCrumb'] = ['Costumers', 'Data', 'Detail'];
        $data['kostumer'] = $kostumer;

        return view('kostumer.detail', $data);
    }

    public function orderDetail($id)
    {
        $customerOrder = CustomerOrder::find($id);
        if (!$customerOrder) {
            return redirect()->back()->with('fail', 'Supplier Order tidak ditemukan');
        }

        $data['title'] = 'Kelola Data Kostumer Order';
        $data['active'] = ['kostumer-order'];
        $data['breadCrumb'] = ['Kostumer', 'Order', 'Data', 'Kelola'];
        $data['kostumerOrder'] = $customerOrder;

        return view('kostumer.order-detail', $data);
    }
}
