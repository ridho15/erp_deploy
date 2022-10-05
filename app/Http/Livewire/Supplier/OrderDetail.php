<?php

namespace App\Http\Livewire\Supplier;

use App\Models\SupplierOrder;
use Livewire\Component;

class OrderDetail extends Component
{
    public $listeners = ['refreshSupplierOrder' => '$refresh'];
    public $id_supplier_order;
    public $supplierOrder;
    public function render()
    {
        $this->supplierOrder = SupplierOrder::find($this->id_supplier_order);
        return view('livewire.supplier.order-detail');
    }

    public function mount($id_supplier_order){
        $this->id_supplier_order = $id_supplier_order;
    }
}
