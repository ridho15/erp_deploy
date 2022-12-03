<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\SupplierOrder as ModelsSupplierOrder;
use Livewire\Component;

class SupplierOrder extends Component
{
    public $listSupplierOrder;
    public $totalBelumSelesai;
    public function render()
    {
        $this->listSupplierOrder = ModelsSupplierOrder::whereHas('supplier')->where('status_order', '!=', 4)
        ->orderBy('created_at', 'ASC')
        ->limit(5)
        ->get();

        $this->totalBelumSelesai = ModelsSupplierOrder::whereHas('supplier')->where('status_order', '!=', 4)
        ->orderBy('created_at', 'ASC')
        ->count();
        return view('livewire.dashboard.supplier-order');
    }
}
