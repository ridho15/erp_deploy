<?php

namespace App\Http\Livewire\Supplier;

use App\Models\SupplierOrderDetail;
use Livewire\Component;
use Livewire\WithPagination;

class OrderDetailList extends Component
{
    use WithPagination;
    public $paginationTheme = 'bootstrap';
    public $listeners = ['refreshSupplierOrderDetail' => '$refresh', 'hapusBarangOrder'];
    public $id_supplier_order;
    protected $listSupplierOrderDetail;
    public $cari;
    public $total_show = 10;
    public function render()
    {
        $this->listSupplierOrderDetail = SupplierOrderDetail::where('id_supplier_order', $this->id_supplier_order)->paginate($this->total_show);
        $data['listSupplierOrderDetail'] = $this->listSupplierOrderDetail;
        return view('livewire.supplier.order-detail-list', $data);
    }

    public function mount($id_supplier_order){
        $this->id_supplier_order = $id_supplier_order;
    }

    public function hapusBarangOrder($id){
        $supplierOderDetail = SupplierOrderDetail::find($id);
        if(!$supplierOderDetail){
            $message = "Data Barang Order tidak ditemukan !";
            return session()->flash('fail', $message);
        }

        $supplierOderDetail->delete();
        $message = "Berhasil menghapus barang dari order";
        return session()->flash('success', $message);
    }
}
