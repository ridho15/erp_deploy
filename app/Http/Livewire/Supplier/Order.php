<?php

namespace App\Http\Livewire\Supplier;

use App\Models\SupplierOrder;
use Livewire\Component;
use Livewire\WithPagination;

class Order extends Component
{
    use WithPagination;
    public $paginationTheme = 'bootstrap';
    public $listeners = ['setIdSupplier', 'refreshSupplierOrder' => '$refresh'];
    public $total_show = 10;
    public $cari;
    public $id_supplier;
    protected $listSupplierOrder;
    public function render()
    {
        $this->listSupplierOrder = SupplierOrder::where(function($query){
            $query->whereHas('user', function($query){
                $query->where('name', 'LIKE', '%' . $this->cari . '%');
            })->orWhereHas('tipePembayaran', function($query){
                $query->where('nama_tipe', 'LIKE', '%' . $this->cari . '%');
            });
        })->where('id_supplier', $this->id_supplier)->paginate($this->total_show);
        $data['listSupplierOrder'] = $this->listSupplierOrder;
        return view('livewire.supplier.order', $data);
    }

    public function mount(){
    }

    public function setIdSupplier($id_supplier){
        $this->id_supplier = $id_supplier;
    }
}
