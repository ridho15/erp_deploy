<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Quotation;
use App\Models\QuotationDetail;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class QuotationController extends Controller
{
    public function index(){
        $data['title'] = "Quotation";
        $data['active'] = ['quotation'];
        $data['breadCrumb'] = ['Quotation', 'Data'];

        return view('quotation.index', $data);
    }

    public function detail($id){
        $quotation = Quotation::find($id);
        if(!$quotation){
            return redirect()->back()->with('fail', 'Data quotation tidak ditemukan');
        }

        $data['title'] = "Detail Quotation";
        $data['active'] = ['quotation'];
        $data['breadCrumb'] = ['Quotation', 'Data', 'Detail'];
        $data['quotation'] = $quotation;

        return view('quotation.detail', $data);
    }

    public function export($id){
        $quotation = Quotation::find($id);
        if(!$quotation){
            return redirect()->back()->with('fail', 'Data quotation tidak ditemukan');
        }
        $data['quotation'] = $quotation;
        $data['user'] = User::find(session()->get('id_user'));
        $pdf = Pdf::loadView('pdf_view.quotation', $data);
        return $pdf->download('quotation_' . strtotime(now()) . '.pdf');
        return view('pdf_view.quotation', $data);
    }
}
