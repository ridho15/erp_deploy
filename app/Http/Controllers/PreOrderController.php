<?php

namespace App\Http\Controllers;

use App\Models\PreOrder;
use App\Models\User;
use App\Models\WebConfig;
use Barryvdh\DomPDF\Facade\Pdf;

class PreOrderController extends Controller
{
    public function index()
    {
        $data['title'] = 'Pre Order';
        $data['active'] = ['pre-order'];
        $data['breadCrumb'] = ['Pre Order', 'Data'];

        return view('pre-order.index', $data);
    }

    public function detail($id)
    {
        $preOrder = PreOrder::find($id);
        if (!$preOrder) {
            return redirect()->back()->with('fail', 'Data Pre Order tidak ditemukan');
        }

        $data['title'] = 'Pre Order Detail';
        $data['active'] = ['pre-order'];
        $data['breadCrumb'] = ['Pre Order', 'Data', 'Detail'];
        $data['preOrder'] = $preOrder;

        return view('pre-order.detail', $data);
    }

    public function invoice($id)
    {
        $preOrder = PreOrder::with('customer', 'preOrderDetail')->find($id);
        if (!$preOrder) {
            return redirect()->back()->with('fail', 'Data Pre Order tidak ditemukan');
        }

        $data['preOrder'] = $preOrder;
        $data['user'] = User::find(session()->get('id_user'));
        $data['web_name'] = WebConfig::where('type', 'name')->first()->value;
        $data['web_description'] = WebConfig::where('type', 'description')->first()->value;
        $data['web_phone'] = WebConfig::where('type', 'phone')->first()->value;
        $data['web_email'] = WebConfig::where('type', 'email')->first()->value;
        $data['web_faksimili'] = WebConfig::where('type', 'faksimili')->first()->value;
        $data['web_logo_perusahaan'] = WebConfig::where('type', 'logo_perusahaan')->first()->value;
        $data['web_alamat'] = WebConfig::where('type', 'alamat')->first()->value;
        $data['web_logo'] = WebConfig::where('type', 'logo')->first()->value;

        $pdf = Pdf::loadView('pdf_view.invoice', $data);

        return $pdf->download('invoice_'.strtotime(now()).'.pdf');

        return view('pdf_view.invoice', $data);
    }
}
