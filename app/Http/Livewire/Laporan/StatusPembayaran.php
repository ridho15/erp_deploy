<?php

namespace App\Http\Livewire\Laporan;

use App\Models\PreOrder;
use Livewire\Component;

class StatusPembayaran extends Component
{
    public $listStatusPembayaran = [];
    public $listData = [];
    public function render()
    {
        $this->listData = [];
        $preOrder = PreOrder::get();
        for ($i=0; $i <=2 ; $i++) {
            if($i == 0){
                $category = "Belum Bayar";
            }elseif($i == 1){
                $category = "Sudah Bayar";
            }elseif($i == 2){
                $category = "Lunas";
            }
            array_push($this->listData, collect([
                'value' => $preOrder->where('status_pembayaran', $i)->count(),
                'category' => $category
            ]));
        }

        $this->dispatchBrowserEvent('contentChangeStatusPembayaran');
        return view('livewire.laporan.status-pembayaran');
    }
}
