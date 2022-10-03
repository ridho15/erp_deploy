<?php

namespace App\Http\Livewire\Supplier;

use App\Models\Supplier;
use App\Models\SupplierBarang;
use Livewire\Component;
use Livewire\WithPagination;

class Barang extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $id_supplier;
    public $supplier;
    protected $listSupplierBarang;
    public function render()
    {
        $this->supplier = Supplier::find($this->id_supplier);
        $this->listSupplierBarang = SupplierBarang::where('is_supplier', $this->id_supplier);
        $data['listSupplierBarang'] = $this->listSupplierBarang;
        return view('livewire.supplier.barang');
    }

    public function mount($id_supplier){
        $this->id_supplier = $id_supplier;
    }
}
