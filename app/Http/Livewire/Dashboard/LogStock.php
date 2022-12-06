<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Barang;
use Livewire\Component;

class LogStock extends Component
{
    public $listBarangStock;
    public $totalStockKurang;
    public function render()
    {
        $this->listBarangStock = Barang::orderBy('stock', 'ASC')->limit(10)->get();
        $this->totalStockKurang = 0;
        $barang = Barang::get();
        foreach ($barang as $item) {
            if($item->stock < $item->min_stock){
                $this->totalStockKurang ++;
            }
        }

        return view('livewire.dashboard.log-stock');
    }
}
