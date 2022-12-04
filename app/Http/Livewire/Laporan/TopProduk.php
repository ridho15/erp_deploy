<?php

namespace App\Http\Livewire\Laporan;

use App\Models\Barang;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class TopProduk extends Component
{
    public $listTopProduk;
    public $listData = [];
    public function render()
    {
        $this->listData = [];
        $this->listTopProduk = Barang::get()->sortByDesc('total_order')->take(15);
        foreach ($this->listTopProduk as $item) {
            array_push($this->listData, collect([
                'value' => $item->total_order,
                'category' => $item->nama
            ]));
        }
        return view('livewire.laporan.top-produk');
    }
}
