<?php

namespace App\Http\Livewire\Kostumer;

use App\Models\Customer;
use App\Models\CustomerOrder;
use Livewire\Component;
use Livewire\WithPagination;

class Order extends Component
{
    use WithPagination;
    public $paginationTheme = 'bootstrap';
    public $listeners = [
        'setIdSupplier',
        'refreshSupplierOrder' => '$refresh',
        'hapusSupplierOrder',
    ];
    public $total_show = 10;
    public $cari;
    public $id_supplier;
    public $kostumer;
    protected $listSupplierOrder;

    public function render()
    {
        $this->listSupplierOrder = CustomerOrder::where(function ($query) {
            $query->whereHas('user', function ($query) {
                $query->where('name', 'LIKE', '%'.$this->cari.'%');
            })->orWhereHas('CustomerOrderDetail', function ($query) {
                $query->whereHas('barang', function ($q) {
                    $q->where('nama', 'LIKE', '%'.$this->cari.'%');
                });
            });
        })->orWhere('id_customer', $this->id_supplier)->paginate($this->total_show);
        $this->kostumer = Customer::find($this->id_supplier);
        $data['listSupplierOrder'] = $this->listSupplierOrder;
        $data['kostumer'] = $this->kostumer;

        return view('livewire.kostumer.order', $data);
    }

    public function mount()
    {
    }

    public function setIdSupplier($id_supplier)
    {
        $this->id_supplier = $id_supplier;
    }

    public function hapusSupplierOrder($id)
    {
        $supplierOrder = CustomerOrder::find($id);
        if (!$supplierOrder) {
            $message = 'Data Order tidak ditemukan !';

            return session()->flash('fail', $message);
        }

        $supplierOrder->delete();
        $message = 'Data Order berhasil di hapus';
        $this->emit('finishSupplierOrder', 1, $message);

        return session()->flash('success', $message);
    }
}
