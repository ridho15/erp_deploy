<?php

namespace App\Http\Livewire\Kostumer;

use App\Http\Controllers\HelperController;
use App\Models\Barang;
use App\Models\Customer;
use App\Models\CustomerOrder;
use App\Models\CustomerOrderDetail;
use Livewire\Component;

class FormOrder extends Component
{
    protected $helper;

    public function __construct()
    {
        $this->helper = new HelperController();
    }

    public $listeners = [
        'simpanDataKostumerOrder',
        'changeBarang',
        'changeStatusOrder',
        'setDataKostumerOrder',
    ];
    public $id_kostumer_order;
    public $id_kostumer;
    public $id_user;
    public $status_order;
    public $total_harga;
    public $total_produk;
    public $keterangan;
    public $kostumer_data;

    public $listBarang;
    public $listStatusOrder;

    public function render()
    {
        $this->listBarang = Barang::get();
        $this->listStatusOrder = $this->helper->getListStatusOrder();
        $this->dispatchBrowserEvent('contentChange');

        return view('livewire.kostumer.form-order');
    }

    public function mount($id)
    {
        $this->id_kostumer = $id;
        $this->kostumer_data = Customer::find($id);
    }

    public function simpanDataKostumerOrder()
    {
        $this->validate([
            'keterangan' => 'nullable|string',
            'status_order' => 'required',
        ], [
            'keterangan.string' => 'Keterangan tidak valid !',
            'status_order.required' => 'Status order tidak boleh kosong',
        ]);

        $data['id_customer'] = $this->id_kostumer;
        $data['id_user'] = session()->get('id_user');
        $data['status_order'] = $this->status_order;
        $data['keterangan'] = $this->keterangan;
        $total_produk = 0;
        $total_harga = 0;

        if ($this->id_kostumer_order) {
            $listKostumerOrderDetail = CustomerOrderDetail::where('id_customer_order', $this->id_kostumer_order)->get();
            foreach ($listKostumerOrderDetail as $item) {
                $total_harga += $item->total_harga * $item->total_produk;
                $total_produk += $item->total_produk;
            }
        }
        $data['total_harga'] = $total_harga;
        $data['total_produk'] = $total_produk;

        CustomerOrder::updateOrCreate([
            'id' => $this->id_kostumer_order,
        ], $data);

        $message = 'Berhasil menyimpan data kostumer order';
        $this->resetInputFields();
        $this->emit('refreshSupplierOrder');
        $this->emit('finishSimpanData', 1, $message);

        return session()->flash('success', $message);
    }

    public function resetInputFields()
    {
        $this->id_kostumer_order = null;
        $this->status_order = null;
        $this->total_harga = null;
        $this->total_produk = null;
        $this->keterangan = null;
    }

    public function changeStatusOrder($status_order)
    {
        $this->status_order = $status_order;
    }

    public function changeBarang($id)
    {
        $this->id_barang = $id;
    }

    public function setDataKostumerOrder($id)
    {
        $kostumerOrder = CustomerOrder::find($id);
        if (!$kostumerOrder) {
            $message = 'Data Kostumer Order tidak ditemukan';

            return session()->flash('fail', $message);
        }

        $this->id_kostumer_order = $kostumerOrder->id;
        $this->id_kostumer = $kostumerOrder->id_customer;
        $this->status_order = $kostumerOrder->status_order;
        $this->id_barang = $kostumerOrder->id_barang;
        $this->keterangan = $kostumerOrder->keterangan;
    }
}
