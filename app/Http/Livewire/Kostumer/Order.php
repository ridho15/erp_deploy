<?php

namespace App\Http\Livewire\Kostumer;

use App\Http\Controllers\HelperController;
use App\Models\Customer;
use App\Models\CustomerOrder;
use Livewire\Component;
use Livewire\WithPagination;

class Order extends Component
{
    use WithPagination;
    public $paginationTheme = 'bootstrap';
    public $listeners = [
        'setIdKostumer',
        'refreshSupplierOrder' => '$refresh',
        'hapusKostumerOrder',
        'finishSupplierOrder',
    ];
    public $total_show = 10;
    public $cari;
    public $id_kostumer;
    public $kostumer;
    protected $listKostumerOrder;

    public function render()
    {
        $this->listKostumerOrder = CustomerOrder::where(function ($query) {
            $query->whereHas('user', function ($query) {
                $query->where('name', 'LIKE', '%'.$this->cari.'%');
            })->orWhereHas('CustomerOrderDetail', function ($query) {
                $query->whereHas('barang', function ($q) {
                    $q->where('nama', 'LIKE', '%'.$this->cari.'%');
                });
            });
        })->orWhere('id_customer', $this->id_kostumer)->paginate($this->total_show);
        $this->kostumer = Customer::find($this->id_kostumer);
        $data['listKostumerOrder'] = $this->listKostumerOrder;
        $data['kostumer'] = $this->kostumer;

        return view('livewire.kostumer.order', $data);
    }

    public function mount($id_customer)
    {
        $this->id_kostumer = $id_customer;
        $this->kostumer = Customer::find($id_customer);
    }

    public function setIdKostumer($id_kostumer)
    {
        $this->id_kostumer = $id_kostumer;
    }

    public function hapusKostumerOrder($id)
    {
        $KostumerOrder = CustomerOrder::find($id);
        if (!$KostumerOrder) {
            $message = 'Data Order tidak ditemukan !';

            return session()->flash('fail', $message);
        }

        $KostumerOrder->delete();
        $message = 'Data Order berhasil di hapus';
        activity()->causedBy(HelperController::user())->log("Menghapus data order");
        // $this->emit('finishSupplierOrder', 1, $message);

        return session()->flash('success', $message);
    }
}
