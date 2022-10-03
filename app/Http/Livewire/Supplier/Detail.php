<?php

namespace App\Http\Livewire\Supplier;

use App\Models\Supplier;
use Livewire\Component;

class Detail extends Component
{
    public $id_supplier;
    public $supplier;
    public function render()
    {
        $this->supplier = Supplier::find($this->id_supplier);
        return view('livewire.supplier.detail');
    }

    public function mount($id_supplier){
        $this->id_supplier = $id_supplier;
    }
}
