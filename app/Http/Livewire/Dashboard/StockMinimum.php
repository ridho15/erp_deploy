<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Barang;
use Livewire\Component;

class StockMinimum extends Component
{
    public $listBarang = [];
    public $totalListBarang = 0;
    public function render()
    {
        $listBarang = Barang::get();
        $jumlah = 0;
        foreach ($listBarang as $item) {
            if ($item->stock < $item->min_stock) {
                if ($jumlah < 5) {
                    array_push($this->listBarang, $item);
                    $jumlah++;
                }
                $this->totalListBarang++;
            }
        }
        return view('livewire.dashboard.stock-minimum');
    }
}
