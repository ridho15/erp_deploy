<?php

namespace App\Http\Livewire\Laporan;

use App\Models\StockOpname as ModelsStockOpname;
use Livewire\Component;
use Livewire\WithPagination;

class StockOpname extends Component
{
    use WithPagination;
    public $paginationTheme = 'bootstrap';
    public $cari;
    public $total_show = 10;

    public $tanggal;
    protected $listStockOpname;
    public function render()
    {
        $this->listStockOpname = ModelsStockOpname::where('tanggal', $this->tanggal)
        ->where(function($query){
            $query->whereHas('barang', function($query){
                $query->where('nama', 'LIKE', '%' . $this->cari . '%');
            });
        })->paginate($this->total_show);

        $data['listStockOpname'] = $this->listStockOpname;

        $this->dispatchBrowserEvent('contentChange');
        return view('livewire.laporan.stock-opname', $data);
    }

    public function mount(){
        $this->tanggal = date('Y-m-d');
    }
}
