<?php

namespace App\Http\Controllers;

use App\Models\PreOrder;
use App\Models\PreOrderDetail;
use App\Models\Quotation;
use App\Models\TipePembayaran;
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

        $tipePembayaran = TipePembayaran::first();
        if(!$tipePembayaran){
            return response()->json([
                'status' => 0,
                'status_message' => 'Error',
                'message' => 'Tipe Pembayaran tidak ditemukan'
            ]);
        }

        $id_customer = null;
        if($quotation->laporanPekerjaan){
            $id_customer = $quotation->laporanPekerjaan->id_customer;
        }elseif($quotation->customer){
            $id_customer = $quotation->id_customer;
        }

        $preOrder = PreOrder::updateOrCreate([
            'id_quotation' => $id
        ], [
            'id_quotation' => $id,
            'status' => 1,
            'id_tipe_pembayaran' => $tipePembayaran->id,
            'id_user' => 0,
            'id_customer' => $id_customer,
            'keterangan' => null,
            'file' => null,
            'id_metode_pembayaran' => null
        ]);

        if ($quotation) {
            foreach ($quotation->quotationDetail as $item) {
                PreOrderDetail::updateOrCreate([
                    'id_pre_order' => $preOrder->id,
                    'id_barang' => $item->id_barang,
                ], [
                    'id_pre_order' => $preOrder->id,
                    'id_barang' => $item->id_barang,
                    'harga' => $item->harga,
                    'qty' => $item->qty,
                    'id_satuan' => $item->id_satuan,
                ]);
            }
        }

        return view('quotation.konfirmasi');
    }
}
