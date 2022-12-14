<?php

namespace App\Http\Livewire\Supplier;

use App\Http\Controllers\HelperController;
use App\Models\SupplierOrderDetailTemp;
use Livewire\Component;
use Livewire\WithPagination;

class OrderTemporary extends Component
{
    use WithPagination;
    public $paginationTheme = 'bootstrap';
    public $listeners = [
        'changeStatusOrderTemporary'
    ];
    public $total_show = 10;
    public $cari;
    public $listOrderTemporary;
    public $openModal = false;
    public function render()
    {
        $this->listOrderTemporary = SupplierOrderDetailTemp::where(function($query){
            $query->whereHas('barang', function($query){
                $query->where('nama', 'LIKE', '%' . $this->cari . '%')
                ->orWhere('deskripsi', 'LIKE', '%' . $this->cari . '%');
            });
        })->where('status', 0)->orderBy('created_at', 'DESC')->get();

        return view('livewire.supplier.order-temporary');
    }

    public function mount(){
        $dataBelumDicheck = SupplierOrderDetailTemp::where('status', 0)
        ->first();
        if($dataBelumDicheck){
            $this->openModal = true;
        }
    }

    public function changeStatusOrderTemporary($id){
        $orderTemporary = SupplierOrderDetailTemp::find($id);
        if($orderTemporary){
            $orderTemporary->update([
                'status' => $orderTemporary->status == 0 ? 1 : 0
            ]);
        }

        $message = "Berhasil menyimpan data";
        activity()->causedBy(HelperController::user())->log("Merubah status order temporary");
        return session()->flash('success', $message);
    }
}
