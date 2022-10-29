<?php

namespace App\Http\Controllers;

use App\Models\Quotation;
use App\Models\User;
use App\Models\WebConfig;
use Barryvdh\DomPDF\Facade\Pdf;

class QuotationController extends Controller
{
    public function index()
    {
        $data['title'] = 'Quotation';
        $data['active'] = ['quotation'];
        $data['breadCrumb'] = ['Quotation', 'Data'];

        return view('quotation.index', $data);
    }

    public function detail($id)
    {
        $quotation = Quotation::find($id);
        if (!$quotation) {
            return redirect()->back()->with('fail', 'Data quotation tidak ditemukan');
        }

        $data['title'] = 'Detail Quotation';
        $data['active'] = ['quotation'];
        $data['breadCrumb'] = ['Quotation', 'Data', 'Detail'];
        $data['quotation'] = $quotation;

        return view('quotation.detail', $data);
    }

    public function export($id)
    {
        $quotation = Quotation::find($id);
        if (!$quotation) {
            return redirect()->back()->with('fail', 'Data quotation tidak ditemukan');
        }
        $data['quotation'] = $quotation;
        $data['user'] = User::find(session()->get('id_user'));

        $data['user'] = User::find(session()->get('id_user'));
        $data['web_name'] = WebConfig::where('type', 'name')->first()->value;
        $data['web_description'] = WebConfig::where('type', 'description')->first()->value;
        $data['web_phone'] = WebConfig::where('type', 'phone')->first()->value;
        $data['web_email'] = WebConfig::where('type', 'email')->first()->value;
        $data['web_faksimili'] = WebConfig::where('type', 'faksimili')->first()->value;
        $data['web_logo_perusahaan'] = WebConfig::where('type', 'logo_perusahaan')->first()->value;
        $data['web_alamat'] = WebConfig::where('type', 'alamat')->first()->value;
        $data['web_logo'] = WebConfig::where('type', 'logo')->first()->value;
        $pdf = Pdf::loadView('pdf_view.quotation', $data);

        return $pdf->download('quotation_'.strtotime(now()).'.pdf');

        return view('pdf_view.quotation', $data);
    }

    public function konfirmasi($id){
        $quotation = Quotation::findOrFail($id);
        $quotation->update([
            'konfirmasi' => 1
        ]);

        return view('quotation.konfirmasi');
    }
}
