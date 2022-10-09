<?php

namespace App\Http\Livewire\Kostumer;

use App\Models\CustomerOrderDetail;
use Livewire\Component;
use Livewire\WithPagination;

class OrderDetailList extends Component
{
    use WithPagination;
    public $paginationTheme = 'bootstrap';
    public $listeners = ['refreshSupplierOrderDetail' => '$refresh', 'hapusBarangOrder'];
    public $id_kostumer_order;
    protected $listKostumerOrderDetail;
    public $cari;
    public $total_show = 10;

    public function render()
    {
        $this->listKostumerOrderDetail = CustomerOrderDetail::where('id_customer_order', $this->id_kostumer_order)->paginate($this->total_show);
        $data['listKostumerOrderDetail'] = $this->listKostumerOrderDetail;

        return view('livewire.kostumer.order-detail-list', $data);
    }

    public function mount($id_kostumer_order)
    {
        $this->id_kostumer_order = $id_kostumer_order;
    }

    public function hapusBarangOrder($id)
    {
        $kostumerOderDetail = CustomerOrderDetail::find($id);
        if (!$kostumerOderDetail) {
            $message = 'Data Barang Order tidak ditemukan !';

            return session()->flash('fail', $message);
        }

        $kostumerOderDetail->delete();
        $message = 'Berhasil menghapus barang dari order';

        return session()->flash('success', $message);
    }
}
