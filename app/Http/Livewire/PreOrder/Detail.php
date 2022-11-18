<?php

namespace App\Http\Livewire\PreOrder;

use App\Models\Barang;
use App\Models\BarangStockLog;
use App\Models\PreOrder;
use App\Models\PreOrderLog;
use Livewire\Component;

class Detail extends Component
{
    public $listeners = [
        'changeStatusPreOrder',
        'preOrderSelesai',
        'refreshPreOrder' => '$refresh'
    ];
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

        PreOrderLog::create([
            'id_pre_order' => $preOrder->id,
            'tanggal' => now(),
            'status' => $status
        ]);

        $message = "Pre Order berhasil di update";
        $this->emit('refreshPreOrderLog');
        $this->emit('finishRefreshData', 1, $message);
        return session()->flash('success', $message);
    }

    public function preOrderSelesai($id, $status){
        $preOrder = PreOrder::find($id);
        if(!$preOrder){
            $message = "Data Pre Order tidak ditemukan !";
            $this->emit('finishRefreshData', 0, $message);
            return session()->flash('fail', $message);
        }

        foreach ($preOrder->preOrderDetail as $item) {
            $barang = Barang::find($item->id_barang);
            if(!$barang){
                $message = "Data barang tidak ditemukan !";
                $this->emit('finishRefreshData', 0, $message);
                return session()->flash('fail', $message);
            }

            if ($preOrder->id_quotation == null) {
                $barang->barangStockChange($item->qty, 4);
            }
        }

        $preOrder->update([
            'status' => 3
        ]);

        PreOrderLog::create([
            'id_pre_order' => $preOrder->id,
            'tanggal' => now(),
            'status' => 3
        ]);

        $message = "Berhasil menyimpan data";
        $this->emit('refreshPreOrderLog');
        $this->emit('refreshPreOrderDetail');
        $this->emit('finishRefreshData', 1, $message);
        return session()->flash('success', $message);
    }
}
