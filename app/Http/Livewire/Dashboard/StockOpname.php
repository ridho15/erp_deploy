<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\StockOpname as ModelsStockOpname;
use Livewire\Component;

class StockOpname extends Component
{
    public $listStockOpname;
    public $totalStockOpname;
    public function render()
    {
        $this->listStockOpname = ModelsStockOpname::whereDate('tanggal', now())
        ->orderBy('tanggal', 'DESC')
        ->take(5)->get();

        $this->totalStockOpname = ModelsStockOpname::whereDate('tanggal', now())
        ->count();
        return view('livewire.dashboard.stock-opname');
    }
}
