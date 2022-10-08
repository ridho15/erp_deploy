<?php

namespace App\Http\Livewire\Supplier;

use App\Http\Livewire\Barang\StockLog;
use App\Models\BarangStockLog;
use App\Models\SupplierOrder;
use Livewire\Component;

class OrderDetail extends Component
{
    public $listeners = ['refreshSupplierOrder' => '$refresh', 'finishSupplierOrder'];
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

        $supplierOrder->update([
            'status_order' => 4
        ]);

        foreach ($supplierOrder->detail as $item) {
            $barang = $item->barang;
            $barang->update([
                'stock' => $barang->stock + $item->qty
            ]);
            BarangStockLog::create([
                'id_barang' => $barang->id,
                'stock_awal' => $barang->stock,
                'perubahan' => $item->qty,
                'tipe_perubahan' => 1,
                'tanggal_perubahan' => now()
            ]);
        }

        $message = "Orderan berhasil diselesaikan";
        $this->emit('statusOrderFinish', 1, $message);
        return session()->flash('success', $message);
    }
}
