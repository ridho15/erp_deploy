<?php

namespace App\Http\Livewire\PreOrder;

use App\Models\Barang;
use App\Models\BarangStockLog;
use App\Models\PreOrder;
use Livewire\Component;

class Detail extends Component
{
    public $listeners = ['changeStatusPreOrder', 'preOrderSelesai'];
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

            BarangStockLog::create([
                'id_barang' => $barang->id,
                'stock_awal' => $barang->stock,
                'perubahan' => $item->qty,
                'tipe_perubahan' => 2,
                'tanggal_perubahan' => now()
             ]);

            $barang->update([
                'stock' => $barang->stock - $item->qty
            ]);
        }

        $preOrder->update([
            'status' => 3
        ]);

        $message = "Berhasil menyimpan data dan mengupdate stock barang";
        $this->emit('refreshPreOrderDetail');
        $this->emit('finishRefreshData', 1, $message);
        return session()->flash('success', $message);
    }
}
