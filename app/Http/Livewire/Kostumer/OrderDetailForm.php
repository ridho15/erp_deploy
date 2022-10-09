<?php

namespace App\Http\Livewire\Kostumer;

use App\Http\Controllers\HelperController;
use App\Models\Barang;
use App\Models\CustomerOrder;
use App\Models\CustomerOrderDetail;
use Livewire\Component;

class OrderDetailForm extends Component
{
    protected $helper;

    public function __construct()
    {
        $this->helper = new HelperController();
    }

    public $listeners = ['simpanDataOrderBarang', 'changeBarang', 'statusOrderChange', 'setDataKostumerOrderDetail'];
    public $id_kostumer_order;
    public $id_kostumer_order_detail;
    public $id_barang;
    public $total_barang;
    public $total_harga;
    public $status_order;
    public $keterangan;
    public $listBarang;
    public $listStatusOrder;
    public $id_kostumer;

    public function render()
    {
        $this->listBarang = Barang::get();
        $this->listStatusOrder = $this->helper->getListStatusOrder();
        $this->dispatchBrowserEvent('contentChange');

        return view('livewire.kostumer.order-detail-form');
    }

    public function mount($id_kostumer_order)
    {
        $this->id_kostumer_order = $id_kostumer_order;
        $kostumerOrder = CustomerOrder::find($this->id_kostumer_order);
        $this->id_kostumer = $kostumerOrder->id_customer;
    }

    public function simpanDataOrderBarang()
    {
        $this->validate([
            'id_barang' => 'required|numeric',
            'total_barang' => 'required|numeric',
            'status_order' => 'required',
            'keterangan' => 'nullable|string',
        ], [
            'id_barang.required' => 'Barang belum dipilih',
            'id_barang.numeric' => 'Barang tidak valid !',
            'total_barang.required' => 'Quantity tidak boleh kosong',
            'status_order.required' => 'Status Order Belum dipilih',
            'status_order.numeric' => 'Status Order tidak valid !',
            'keterangan.string' => 'Keterangan tidak valid !',
        ]);

        // Check Barang
        $barang = Barang::find($this->id_barang);
        if (!$barang) {
            $message = 'Barang tidak ditemukan';

            return session()->flash('fail', $message);
        }
        $data = [
            'id_customer_order' => $this->id_kostumer_order,
            'id_produk' => $this->id_barang,
            'total_produk' => $this->total_barang,
            'total_harga' => $barang->harga,
            'status_order' => $this->status_order,
            'keterangan' => $this->keterangan,
        ];
        CustomerOrderDetail::updateOrCreate([
            'id' => $this->id_kostumer_order_detail,
        ], $data);

        // Update Total Harga
        $kostumerOrder = CustomerOrder::find($this->id_kostumer_order);
        $total_harga = 0;
        foreach ($kostumerOrder->detail as $item) {
            $total_harga += $item->total_harga * $item->total_produk;
        }
        $kostumerOrder->update([
            'total_harga' => $total_harga,
        ]);

        $message = 'Barang berhasil di tambahkan ke orderan';
        $this->resetInputFields();
        $this->emit('refreshSupplierOrderDetail');
        $this->emit('refreshSupplierOrder');
        $this->emit('finishSimpanData', 1, $message);

        return session()->flash('success', $message);
    }

    public function resetInputFields()
    {
        $this->id_kostumer_order_detail = null;
        $this->id_barang = null;
        $this->total_harga = null;
        $this->total_barang = null;
        $this->status_order = null;
        $this->keterangan = null;
    }

    public function statusOrderChange($status_order)
    {
        $this->status_order = $status_order;
    }

    public function changeBarang($id_barang)
    {
        $this->id_barang = $id_barang;
    }

    public function setDatakostumerOrderDetail($id)
    {
        $kostumerOrderDetail = CustomerOrderDetail::find($id);
        if (!$kostumerOrderDetail) {
            $message = 'Data Orderan Barang tidak ditemukan !';

            return session()->flash('fail', $message);
        }

        $this->id_kostumer_order_detail = $kostumerOrderDetail->id;
        $this->id_kostumer_order = $kostumerOrderDetail->id_kostumer_order;
        $this->id_barang = $kostumerOrderDetail->id_barang;
        $this->qty = $kostumerOrderDetail->qty;
        $this->status_order = $kostumerOrderDetail->status_order;
        $this->keterangan = $kostumerOrderDetail->keterangan;
    }
}
