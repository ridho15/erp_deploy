<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\SupplierOrder;
use Livewire\Component;

class AccountPayable extends Component
{
    public $listSupplierOrder;
    public $totalSupplierOrder;
    public function render()
    {
        $this->listSupplierOrder = SupplierOrder::where('status_pembayaran', '!=',2)
        ->where('status_order', '!=', 0)
        ->whereHas('supplier')
        ->orderBy('updated_at', 'DESC')
        ->take(5)->get();

        $this->totalSupplierOrder = SupplierOrder::where('status_pembayaran', '!=',2)
        ->where('status_order', '!=', 0)
        ->whereHas('supplier')
        ->orderBy('updated_at', 'DESC')
        ->count();

        return view('livewire.dashboard.account-payable');
    }
}
