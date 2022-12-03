<?php

namespace App\Http\Livewire\Inventory;

use App\Models\Barang;
use App\Models\StockOpname as ModelsStockOpname;
use Livewire\Component;
use Livewire\WithPagination;

class StockOpname extends Component
{
    use WithPagination;
    public $paginationTheme = 'bootstrap';
    public $total_show = 10;
    public $cari;
    public $listeners = [
        'refreshStockOpname' => '$refresh'
    ];

    public $tanggal;
    protected $listStockOpname;

    public function render()
    {
        $this->listStockOpname = ModelsStockOpname::where(function($query){
            $query->whereHas('barang', function($query){
                $query->where('nama', 'LIKE', '%' . $this->cari . '%');
            });
        })->paginate($this->total_show);

        $data['listStockOpname'] = $this->listStockOpname;
        return view('livewire.inventory.stock-opname', $data);
    }

    public function mount(){
        $this->tanggal = date('Y-m-d');
    }


}
