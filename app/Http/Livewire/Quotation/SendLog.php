<?php

namespace App\Http\Livewire\Quotation;

use App\Models\QuotationSendLog;
use Livewire\Component;

class SendLog extends Component
{
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
}
