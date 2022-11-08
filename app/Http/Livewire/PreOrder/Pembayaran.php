<?php

namespace App\Http\Livewire\PreOrder;

use App\Models\PreOrder;
use App\Models\PreOrderBayar;
use Livewire\Component;

class Pembayaran extends Component
{
    public $listeners = [
        'simpanPreOrderBayar',
    ];
    public $id_pre_order;
    public $preOrder;
    public $listPreOrderBayar;
    public $pembayaran_sekarang;
    public $sudah_bayar;
    public function render()
    {
        $this->listPreOrderBayar = PreOrderBayar::where('id_pre_order', $this->id_pre_order)
        ->orderBy('updated_at', 'DESC')
        ->get();
        $total_bayar = 0;
        foreach ($this->listPreOrderBayar as $item) {
            $total_bayar += $item->pembayaran_sekarang;
        }
        $this->sudah_bayar = $total_bayar;
        return view('livewire.pre-order.pembayaran');
    }

    public function mount($id_pre_order){
        $this->id_pre_order = $id_pre_order;
        $this->preOrder = PreOrder::find($this->id_pre_order);
    }

    public function simpanPreOrderBayar(){
        $this->validate([
            'pembayaran_sekarang' => 'required|numeric'
        ], [
            'pembayaran_sekarang.required' => 'Jumlah bayar tidak boleh kosong',
            'pembayaran_sekarang.numeric' => 'Jumlah bayar tidak valid !'
        ]);

        $preOrderBayar = PreOrderBayar::where('id_pre_order', $this->id_pre_order)->get();
        $total_bayar = 0;
        foreach ($preOrderBayar as $item) {
            $total_bayar += $item->pembayaran_sekarang;
        }

        $this->sudah_bayar = $total_bayar;
        if($this->preOrder->total_bayar < ($this->sudah_bayar + $this->pembayaran_sekarang)){
            $message = 'Jumlah yang di bayarkan melebihi total pembayaran pre order';
            return session()->flash('fail', $message);
        }
        PreOrderBayar::create([
            'id_pre_order' => $this->id_pre_order,
            'total_bayar_sebelumnya' => $this->sudah_bayar,
            'pembayaran_sekarang' => $this->pembayaran_sekarang
        ]);

        $message = "Berhasil melakukan pembayaran";
        $this->emit('finishSimpanData', 1, $message);
        return session()->flash('success', $message);
    }
}
