<?php

namespace App\Http\Livewire\Inventory;

use App\Models\Barang;
use Livewire\Component;
use Livewire\WithPagination;

class StockBarang extends Component
{
    use WithPagination;
    public $listeners = ['refreshStockBarang' => '$refresh'];
    public $paginationTheme = 'bootstrap';
    public $cari;
    public $total_show = 10;
    protected $listBarang;
    public function render()
    {
        $this->listBarang = Barang::where(function($query){
            $query->where('nama', 'LIKE', '%' . $this->cari . '%')
            ->orWhere('stock', 'LIKE', '%' . $this->cari . '%')
            ->orWhere('min_stock', 'LIKE', '%' . $this->cari . '%')
            ->orWhere('harga', 'LIKE', '%' . $this->cari . '%')
            ->orWhere('deskripsi', 'LIKE', '%' . $this->cari . '%')
            ->orWhereHas('satuan', function($query){
                $query->where('nama_satuan', 'LIKE', '%' . $this-> cari . '%');
            })->orWhereHas('tipeBarang', function($query){
                $query->where('tipe_barang', 'LIKE', '%' . $this->cari . '%');
            });
        })->orderBy('stock', 'ASC')->paginate($this->total_show);
        $data['listBarang'] = $this->listBarang;
        return view('livewire.inventory.stock-barang', $data);
    }

    public function mount(){

    }
}
