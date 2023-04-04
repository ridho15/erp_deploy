<?php

namespace App\Http\Livewire\Supplier;

use App\Http\Controllers\HelperController;
use App\Models\IsiRak;
use App\Models\Rak;
use App\Models\RakLog;
use App\Models\SupplierOrder;
use App\Models\SupplierOrderDetail;
use Livewire\Component;

class OrderToRak extends Component
{
    public $listeners = [
        'refreshOrderToRak' => '$refresh',
        'simpanBarangKeRak',
        'finishPindahKeRak'
    ];
    public $id_supplier_order;
    public $listSupplierOrderDetail;
    public $listRak;
    public function render()
    {
        $this->listRak = Rak::get();
        $this->listSupplierOrderDetail = SupplierOrderDetail::where('status_order', 4)
        ->where('id_supplier_order', $this->id_supplier_order)->get();
        $this->dispatchBrowserEvent('contentChange');
        return view('livewire.supplier.order-to-rak');
    }

    public function mount($id_supplier_order){
        $this->id_supplier_order = $id_supplier_order;
    }

    public function simpanBarangKeRak($id_rak = null, $kode_masuk = null){
        if($id_rak == null || $kode_masuk == null){
            $message = "Rak atau Kode masuk masih kosong";
            return session()->flash('fail', $message);
        }

        $supplierOrderDetail = SupplierOrderDetail::find($kode_masuk);
        $data = [
            'id_rak' => $id_rak,
            'id_barang' => $supplierOrderDetail->id_barang,
            'kode_masuk' => $kode_masuk,
            'jumlah' => $supplierOrderDetail->qty,
        ];
        IsiRak::updateOrCreate([
            'id_barang' => $supplierOrderDetail->id_barang,
            'kode_masuk' => $kode_masuk,
            'jumlah' => $supplierOrderDetail->qty,
        ], $data);

        activity()->causedBy(HelperController::user())->log("Memasukkan barang ke dalam rak dari suppiler order");

        $message = "Berhasil memasukkan barang ke rak";
        return session()->flash('success', $message);
    }

    public function finishPindahKeRak(){
        $total_harga = 0;
        if(count($this->listSupplierOrderDetail) <= 0){
            $message = "Tidak ada barang yang dimasukkan ke rak. silahkan confirmasi lagi pemesanan";
            return session()->flash('fail', $message);
        }
        foreach ($this->listSupplierOrderDetail as $item) {
            $isiRak = IsiRak::where('id_barang', $item->id_barang)
            ->where('jumlah', $item->qty)
            ->where('kode_masuk', $item->id)
            ->first();

            if(!$isiRak){
                $message = "Masih ada barang yang belum di masukkan ke dalam rak";
                return session()->flash('fail', $message);
            }

            RakLog::create([
                'id_rak' => $isiRak->id_rak,
                'id_barang' => $item->id_barang,
                'status' => 1,
                'jumlah' => $item->qty,
                'keterangan' => "Barang Masuk"
            ]);

            $barang = $item->barang;
            $barang->barangStockChange($item->qty, 3);
            $total_harga += $item->harga_satuan * $item->qty;
        }

        $supplierOrder = SupplierOrder::find($this->id_supplier_order);
        $supplierOrder->update([
            'status_order' => 4,
            'total_harga' => $total_harga
        ]);

        activity()->causedBy(HelperController::user())->log("Menyelesaikan supplier order");
        $message = "Berhasil mengupdate supplier order menjadi selesai";
        $this->emit('refreshSupplierOrder');
        $this->emit('finishSimpanData', 1, $message);
        return session()->flash('success', $message);
    }
}
