<?php

namespace App\Http\Livewire\Supplier;

use App\Http\Controllers\HelperController;
use App\Http\Livewire\Barang\StockLog;
use App\Models\BarangStockLog;
use App\Models\SupplierOrder;
use Livewire\Component;

class OrderDetail extends Component
{
    public $listeners = [
        'refreshSupplierOrder' => '$refresh',
        'finishSupplierOrder'
    ];
    public $id_supplier_order;
    public $supplierOrder;
    public function render()
    {
        $this->supplierOrder = SupplierOrder::find($this->id_supplier_order);
        return view('livewire.supplier.order-detail');
    }

    public function mount($id_supplier_order){
        $this->id_supplier_order = $id_supplier_order;
    }

    public function finishSupplierOrder($id){
        $supplierOrder = SupplierOrder::find($id);
        if(!$supplierOrder){
            $message = 'Supplier Order tidak ditemukan !';
            return session()->flash('fail', $message);
        }

        $total_harga = 0;
        foreach ($supplierOrder->detail as $item) {
            if($item->status_order != 0){
                $barang = $item->barang;
                $barang->barangStockChange($item->qty, 3);
                $total_harga += $item->harga_satuan * $item->qty;
            }
        }

        $supplierOrder->update([
            'status_order' => 4,
            'total_harga' => $total_harga,
        ]);

        $message = "Orderan berhasil diselesaikan";
        activity()->causedBy(HelperController::user())->log("Order Berhasil di selesai");
        $this->emit('statusOrderFinish', 1, $message);
        return session()->flash('success', $message);
    }
}
