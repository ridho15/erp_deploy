<?php

namespace App\Http\Livewire\PreOrder;

use App\Models\PreOrder;
use Livewire\Component;

class Detail extends Component
{
    public $id_pre_order;
    public $preOrder;
    public function render()
    {
        $this->preOrder = PreOrder::find($this->id_pre_order);
        return view('livewire.pre-order.detail');
    }

    public function mount($id_pre_order){
        $this->id_pre_order = $id_pre_order;
    }
}
