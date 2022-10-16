<?php

namespace App\Http\Livewire\PreOrder;

use App\Models\PreOrder;
use Livewire\Component;

class Detail extends Component
{
    public $listeners = ['changeStatusPreOrder'];
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

    public function changeStatusPreOrder($id, $status){
        $preOrder = PreOrder::find($id);
        if(!$preOrder){
            $message = "Data Pre Order tidak ditemukan !";
            $this->emit('finishRefreshData', 0, $message);
            return session()->flash('fail', $message);
        }

        $preOrder->update([
            'status' => $status
        ]);

        $message = "Pre Order berhasil di update";
        $this->emit('finishRefreshData', 1, $message);
        return session()->flash('success', $message);
    }
}
