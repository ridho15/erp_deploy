<?php

namespace App\Http\Livewire\Kostumer;

use App\Models\CustomerOrder;
use Livewire\Component;

class OrderDetails extends Component
{
    public $listeners = ['refreshSupplierOrder' => '$refresh'];
    public $id_kostumer_order;
    public $kostumerOrder;

    public function render()
    {
        $this->kostumerOrder = CustomerOrder::find($this->id_kostumer_order);

        return view('livewire.kostumer.order-details');
    }

    public function mount($id_kostumer_order)
    {
        $this->id_kostumer_order = $id_kostumer_order;
    }
}
