<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Quotation as ModelsQuotation;
use Carbon\Carbon;
use Livewire\Component;

class Quotation extends Component
{
    public $listQuotation;
    public $totalNotSend;
    public function render()
    {
        $now = Carbon::now()->subDays(3);
        $this->listQuotation = ModelsQuotation::where('status', 0)
        ->where('created_at', '<=', $now)
        ->limit(5)->get();

        $this->totalNotSend = ModelsQuotation::where('status',0)
        ->where('created_at', '<=', $now)
        ->count();
        return view('livewire.dashboard.quotation');
    }
}
