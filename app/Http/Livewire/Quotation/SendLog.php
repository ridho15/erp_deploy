<?php

namespace App\Http\Livewire\Quotation;

use App\Mail\SendQuotationMail;
use App\Models\Quotation;
use App\Models\QuotationSendLog;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class SendLog extends Component
{
    public $listeners = [
        'sendQuotationToCustomer'
    ];
    public $id_quotation;
    public $listQuotationSendLog = [];
    public function render()
    {
        $this->listQuotationSendLog = QuotationSendLog::where('id_quotation', $this->id_quotation)->get();
        return view('livewire.quotation.send-log');
    }

    public function mount($id_quotation){
        $this->id_quotation = $id_quotation;
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
