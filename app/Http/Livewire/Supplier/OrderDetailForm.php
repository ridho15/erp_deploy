<?php

namespace App\Http\Livewire\Supplier;

use App\Http\Controllers\HelperController;
use App\Models\Barang;
use App\Models\SupplierOrder;
use App\Models\SupplierOrderDetail;
use Livewire\Component;

class OrderDetailForm extends Component
{
    protected $helper;
    function __construct()
    {
        $this->helper = new HelperController;
    }
    public $listeners = ['simpanDataOrderBarang', 'changeBarang', 'statusOrderChange', 'setDataSupplierOrderDetail'];
    public $id_supplier_order;
    public $id_supplier_order_detail;
    public $id_barang;
    public $qty;
    public $harga_satuan;
    public $status_order;
    public $keterangan;
    public $listBarang;
    public $listStatusOrder;
    public $id_supplier;
    public function render()
    {
        $this->listBarang = Barang::whereHas('supplierBarang', function($query){
            $query->where('id_supplier', $this->id_supplier);
        })->get();
        $this->listStatusOrder = $this->helper->getListStatusOrder();
        $this->dispatchBrowserEvent('contentChange');
        return view('livewire.supplier.order-detail-form');
    }

    public function mount($id_supplier_order){
        $this->id_supplier_order = $id_supplier_order;
        $supplierOrder = SupplierOrder::find($this->id_supplier_order);
        $this->id_supplier = $supplierOrder->id_supplier;
    }

    public function simpanDataOrderBarang(){
        $this->validate([
            'id_supplier_order' => 'required|numeric',
            'id_barang' => 'required|numeric',
            'qty' => 'required|numeric',
            'status_order' => 'required|numeric',
            'keterangan' => 'nullable|string'
        ], [
            'id_supplier_order.required' => "Supplier Order Tidak Valid !",
            'id_supplier_order.numeric' => 'Supplier Order tidak valid !',
            'id_barang.required' => 'Barang belum dipilih',
            'id_barang.numeric' => 'Barang tidak valid !',
            'qty.required' => 'Quantity tidak boleh kosong',
            'qty.numeric' => 'Quantity tidak valid',
            'status_order.required' => 'Status Order Belum dipilih',
            'status_order.numeric' => 'Status Order tidak valid !',
            'keterangan.string' => 'Keterangan tidak valid !',
        ]);

        // Check Barang
        $barang = Barang::find($this->id_barang);
        if(!$barang){
            $message = "Barang tidak ditemukan";
            return session()->flash('fail', $message);
        }
        $data = [
            'id_supplier_order' => $this->id_supplier_order,
            'id_barang' => $this->id_barang,
            'qty' => $this->qty,
            'harga_satuan' => $barang->harga,
            'status_order' => $this->status_order,
            'keterangan' => $this->keterangan
        ];
        SupplierOrderDetail::updateOrCreate([
            'id' => $this->id_supplier_order_detail
        ], $data);

        // Update Total Harga
        $supplierOrder = SupplierOrder::find($this->id_supplier_order);
        $total_harga = 0;
        foreach ($supplierOrder->detail as $item) {
            $total_harga += $item->harga_satuan * $item->qty;
        }
        $supplierOrder->update([
            'total_harga' => $total_harga
        ]);

        $message = "Barang berhasil di tambahkan ke orderan";
        $this->resetInputFields();
        $this->emit('refreshSupplierOrderDetail');
        $this->emit('refreshSupplierOrder');
        $this->emit('finishSimpanData', 1, $message);
        return session()->flash('success', $message);
    }

    public function resetInputFields(){
        $this->id_supplier_order_detail = null;
        $this->id_barang = null;
        $this->qty = null;
        $this->status_order = null;
        $this->keterangan = null;
    }

    public function statusOrderChange($status_order){
        $this->status_order = $status_order;
    }

    public function changeBarang($id_barang){
        $this->id_barang = $id_barang;
    }

    public function setDataSupplierOrderDetail($id){
        $supplierOrderDetail = SupplierOrderDetail::find($id);
        if(!$supplierOrderDetail){
            $message = "Data Orderan Barang tidak ditemukan !";

            return session()->flash('fail', $message);
        }

        $this->id_supplier_order_detail = $supplierOrderDetail->id;
        $this->id_supplier_order = $supplierOrderDetail->id_supplier_order;
        $this->id_barang = $supplierOrderDetail->id_barang;
        $this->qty = $supplierOrderDetail->qty;
        $this->status_order = $supplierOrderDetail->status_order;
        $this->keterangan = $supplierOrderDetail->keterangan;
    }
}
