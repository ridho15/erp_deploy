<?php

namespace App\Http\Livewire\PreOrder;

use App\Models\PreOrder;
use Livewire\Component;

class Preview extends Component
{
    public $listeners = [
        'setPurchaseOrderPreview'
    ];
    public $id_purchase_order;
    public $purchaseOrder;
    public $listPreOrderDetail = [];
    public function render()
    {
        return view('livewire.pre-order.preview');
    }

    public function mount(){

    }

    public function setPurchaseOrderPreview($id){
        $this->id_purchase_order = $id;
        $this->purchaseOrder = PreOrder::find($this->id_purchase_order);
        $this->listPreOrderDetail = $this->purchaseOrder->preOrderDetail;
    }
}
