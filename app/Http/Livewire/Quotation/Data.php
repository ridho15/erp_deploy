<?php

namespace App\Http\Livewire\Quotation;

use App\Mail\SendQuotationMail;
use App\Models\Quotation;
use App\Models\QuotationSendLog;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Livewire\WithPagination;

class Data extends Component
{
    use WithPagination;
    public $listeners = [
        'refreshQuotation' => '$refresh',
        'hapusQuotation',
        'sendQuotationToCustomer'
    ];
    public $paginationTheme = 'bootstrap';
    public $total_show = 10;
    public $cari;
    protected $listQuotation = [];
    public function render()
    {
        $this->listQuotation = Quotation::paginate($this->total_show);
        $data['listQuotation'] = $this->listQuotation;
        return view('livewire.quotation.data', $data);
    }

    public function hapusQuotation($id){
        $quotation = Quotation::find($id);
        if(!$quotation){
            $mesasge = "Data quotaion tidak ditemukan !";

            return session()->flash('fail', $mesasge);
        }

        $quotation->delete();
        $mesasge = "Berhasil menghapus quotation";
        $this->emit('finishRefreshQuotation', 1, $mesasge);
        return session()->flash('success', $mesasge);
    }

    public function sendQuotationToCustomer($id){
        // Check Quotation
        $quotation = Quotation::find($id);
        if(!$quotation){
            $mesasge = "Data Quotation tidak ditemukan !";
            $this->emit('finishRefreshData',0, $mesasge);
            return session()->flash('fail', $mesasge);
        }
        $email = null;
        if($quotation->laporanPekerjaan){
            $email = $quotation->laporanPekerjaan->customer->email;
        }elseif($quotation->customer){
            $email = $quotation->customer->email;
        }
        if ($email) {
            Mail::to($email)->send(new SendQuotationMail($id));
            $quotation->update([
                'status' => 1,
            ]);
        }
        QuotationSendLog::create([
            'id_quotation' => $quotation->id,
            'id_user' => session()->get('id_user'),
            'tanggal' => now()
        ]);
        $message= "Quotation Berhasil dikirim";
        $this->emit('finishRefreshData', 1, $message);
        return session()->flash('success', $message);
    }
}
