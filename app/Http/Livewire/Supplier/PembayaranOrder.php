<?php

namespace App\Http\Livewire\Supplier;

use App\Http\Controllers\HelperController;
use App\Models\SupplierOrder;
use App\Models\SupplierOrderPembayaran;
use Livewire\Component;
use Livewire\WithFileUploads;

class PembayaranOrder extends Component
{
    use WithFileUploads;
    public $listeners = [
        'simpanSupplierOrderPembayaran',
        'setPembayaranSekarang',
        'hapusBuktiBayar'
    ];
    public $id_supplier_order;
    public $bukti_bayar;
    public $total_bayar_sebelumnya;
    public $pembayaran_sekarang;
    public $tanggal_pembayaran;
    public $total_bayar;
    public $sudah_bayar;
    public $sisa_bayar;

    public $listSupplierOrderPembayaran;

    public function render()
    {
        $this->listSupplierOrderPembayaran = SupplierOrderPembayaran::where('id_supplier_order', $this->id_supplier_order)->get();
        return view('livewire.supplier.pembayaran-order');
    }

    public function mount($id_supplier_order){
        $this->id_supplier_order = $id_supplier_order;
    }

    public function simpanSupplierOrderPembayaran(){
        $this->validate([
            'id_supplier_order' => 'required|numeric',
            'bukti_bayar' => 'required|mimes:jpg,png,jpeg,pdf',
            'pembayaran_sekarang' => 'required|numeric',
        ], [
            'id_supplier_order.required' => 'Supplier Order tidak ditemukan !',
            'id_supplier_order.numeric' => 'Supplier order tidak valid !',
            'bukti_bayar.required' => 'Bukti pembayaran tidak boleh kosong',
            'bukti_bayar.mimes' => 'Bukti pembayaran tidak valid !',
            'pembayaran_sekarang.required' => 'Pembayaran tidak boleh kosong',
            'pembayaran_sekarang.numeric' => 'Pembayaran tidak valid !'
        ]);

        $total_bayar_sebelumnya = 0;
        $supplierOrder = SupplierOrder::find($this->id_supplier_order);
        if(!$supplierOrder){
            $message = "Supplier order tidak ditemukan";
            return session()->flash('fail', $message);
        }
        foreach ($supplierOrder->supplierOrderPembayaran as $item) {
            $total_bayar_sebelumnya += $item->pembayaran_sekarang;
        }

        if(($total_bayar_sebelumnya + $this->pembayaran_sekarang) > $supplierOrder->total_harga){
            $message = "Pembayaran melebihi yang seharusnya di bayarkan, silahkan check pembayaran sebelumnya";
            return session()->flash('fail', $message);
        }

        if($this->bukti_bayar){
            $path = $this->bukti_bayar->store('public/bukti_pembayaran');
            $path = str_replace('public', '', $path);
            $data['bukti_bayar'] = $path;
        }
        $data['id_supplier_order'] = $this->id_supplier_order;
        $data['pembayaran_sekarang'] = $this->pembayaran_sekarang;
        $data['total_bayar_sebelumnya'] = $total_bayar_sebelumnya;
        $data['tanggal_pembayaran'] = $this->tanggal_pembayaran;

        SupplierOrderPembayaran::create($data);
        if(($total_bayar_sebelumnya + $this->pembayaran_sekarang) == $supplierOrder->total_harga){
            $supplierOrder->update([
                'status_pembayaran' => 2
            ]);
        }else{
            $supplierOrder->update([
                'status_pembayaran' => 1
            ]);
        }
        $message = "Berhasil melakukan pembayaran";
        activity()->causedBy(HelperController::user())->log("Melakuan pembayaran supplier order");
        $this->resetInputFields();
        $this->emit('refreshSupplierOrder');
        $this->emit('finishSimpanData', 1, $message);
        return session()->flash('success', $message);
    }

    public function resetInputFields(){
        $this->bukti_bayar = null;
        $this->pembayaran_sekarang = null;
        $this->tanggal_pembayaran = null;
    }

    public function setPembayaranSekarang(){
        if($this->id_supplier_order){
            $supplierOrder = SupplierOrder::find($this->id_supplier_order);
            $this->total_bayar = $supplierOrder->total_harga;
            $this->sudah_bayar = 0;
            foreach ($supplierOrder->supplierOrderPembayaran as $item) {
                $this->sudah_bayar += $item->pembayaran_sekarang;
            }

            $this->sisa_bayar = $this->total_bayar - $this->sudah_bayar;
            $this->pembayaran_sekarang = $this->sisa_bayar;
        }
    }

    public function hapusBuktiBayar(){
        $this->bukti_bayar = null;
    }
}
