<?php

namespace App\Http\Livewire\PreOrder;

use App\Models\PreOrder;
use Livewire\Component;

class Preview extends Component
{
    public $listeners = [
        'setPurchaseOrderPreview',
        'showEditPpn',
        'simpanPpn'
    ];
    public $id_purchase_order;
    public $purchaseOrder;
    public $ppn;
    public $show_edit = false;
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
        if(isset($this->purchaseOrder->quotation)){
            $this->ppn = $this->purchaseOrder->quotation->ppn;
        }elseif($this->purchaseOrder->projectUnit->project->customer){
            $this->ppn = $this->purchaseOrder->projectUnit->project->customer->ppn;
        }
    }

    public function showEditPpn(){
        $this->show_edit = !$this->show_edit;
    }

    public function simpanPpn(){
        if(isset($this->purchaseOrder->quotation)){
            $this->purchaseOrder->quotation->update([
                'ppn' => $this->ppn
            ]);
        }elseif($this->purchaseOrder->projectUnit->project->customer){
            $this->purchaseOrder->projectUnit->project->customer->update([
                'ppn' => $this->ppn
            ]);
        }

        $this->show_edit = false;
    }
}
