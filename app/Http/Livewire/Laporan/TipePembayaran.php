<?php

namespace App\Http\Livewire\Laporan;

use App\Models\TipePembayaran as ModelsTipePembayaran;
use Livewire\Component;

class TipePembayaran extends Component
{
    public $listTipePembayaran = [];
    public $listData = [];
    public function render()
    {
        $this->listData = [];
        $this->listTipePembayaran = ModelsTipePembayaran::get()->sortByDesc('total_order')->take(15);
        foreach ($this->listTipePembayaran as $item) {
            array_push($this->listData, collect([
                'value' => $item->total_order,
                'category' => $item->nama_tipe
            ]));
        }

        $this->dispatchBrowserEvent('contentChangeTipePembayaran');
        return view('livewire.laporan.tipe-pembayaran');
    }

    public function mount(){

    }
}
