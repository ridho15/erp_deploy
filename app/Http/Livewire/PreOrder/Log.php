<?php

namespace App\Http\Livewire\PreOrder;

use App\Models\PreOrderLog;
use Livewire\Component;

class Log extends Component
{
    public $listeners = ['refreshPreOrderLog' => '$refresh'];
    public $id_pre_order;
    public $listPreOrderLog;
    public function render()
    {
        $this->listPreOrderLog = PreOrderLog::where('id_pre_order', $this->id_pre_order)
        ->orderBy('tanggal', 'DESC')->get();
        return view('livewire.pre-order.log');
    }

    public function mount($id_pre_order){
        $this->id_pre_order = $id_pre_order;
    }
}
