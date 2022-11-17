<?php

namespace App\Http\Livewire\Supplier;

use App\Http\Controllers\HelperController;
use App\Models\Supplier;
use App\Models\SupplierOrder;
use App\Models\SupplierOrderDetail;
use App\Models\TipePembayaran;
use Livewire\Component;

class FormOrder extends Component
{
    protected $helper;

    public function __construct()
    {
        $this->helper = new HelperController();
    }

    public $listeners = [
        'simpanDataSupplierOrder',
        'changeSupplier',
        'changeStatusOrder',
        'changeTipePembayaran',
        'setDataSupplierOrder',
    ];
    public $id_supplier_order;
    public $id_supplier;
    public $id_user;
    public $status_order;
    public $total_harga;
    public $tanggal_order;
    public $keterangan;
    public $id_tipe_pembayaran;

    public $listSupplier;
    public $listStatusOrder;
    public $listTipePembayaran;

    public function render()
    {
        if ($this->id_supplier_order == null) {
            $this->status_order = 1;
        }
        $this->listSupplier = Supplier::get();
        $this->listStatusOrder = $this->helper->getListStatusOrder()->where('status_order', '!=', 4);
        $this->listTipePembayaran = TipePembayaran::get();

        $this->dispatchBrowserEvent('contentChange');
        return view('livewire.supplier.form-order');
    }

    public function mount()
    {
    }

    public function simpanDataSupplierOrder()
    {
        $this->validate([
            'id_supplier' => 'required|numeric',
            'tanggal_order' => 'required|date',
            'keterangan' => 'nullable|string',
            'id_tipe_pembayaran' => 'required|numeric',
            'status_order' => 'required|numeric',
        ], [
            'id_supplier.required' => 'Supplier belum dipilih !',
            'id_supplier.numeric' => 'Supplier tidak valid !',
            'tanggal_order.required' => 'Tanggal order tidak boleh kosong',
            'tanggal_order.date' => 'Tanggal order tidak valid !',
            'keterangan.string' => 'Keterangan tidak valid !',
            'id_tipe_pembayaran.required' => 'Tipe pembayaran belum dipilih',
            'id_tipe_pembayaran.numeric' => 'Tipe pembayaran tidak valid !',
            'status_order.required' => 'Status order tidak boleh kosong',
            'status_order.numeric' => 'Status order tidak valid !',
        ]);

        // Check Supplier
        $supplier = Supplier::find($this->id_supplier);
        if (!$supplier) {
            $message = 'Data supplier tidak ditemukan';

            return session()->flash('fail', $message);
        }

        // Check tipe pembayaran
        $tipePembayaran = TipePembayaran::find($this->id_tipe_pembayaran);
        if (!$tipePembayaran) {
            $message = 'Tipe pembayaran tidak ditemukan';

            return session()->flash('fail', $message);
        }

        $data['id_supplier'] = $this->id_supplier;
        $data['id_user'] = session()->get('id_user');
        $data['status_order'] = $this->status_order;
        $data['tanggal_order'] = $this->tanggal_order;
        $data['keterangan'] = $this->keterangan;
        $data['id_tipe_pembayaran'] = $this->id_tipe_pembayaran;
        $total_harga = 0;
        if ($this->id_supplier_order) {
            $listSupplierOrderDetail = SupplierOrderDetail::where('id_supplier_order', $this->id_supplier_order)->get();
            foreach ($listSupplierOrderDetail as $item) {
                $total_harga += $item->harga_satuan * $item->qty;
            }
        }
        $data['total_harga'] = $total_harga;
        SupplierOrder::updateOrCreate([
            'id' => $this->id_supplier_order,
        ], $data);

        $message = 'Berhasil menyimpan data supplier order';
        $this->resetInputFields();
        $this->emit('refreshSupplierOrder');
        $this->emit('refreshSupplierOrderDetail');
        $this->emit('finishSimpanData', 1, $message);

        return session()->flash('success', $message);
    }

    public function resetInputFields()
    {
        $this->id_supplier_order = null;
        $this->id_supplier = null;
        $this->id_user = null;
        $this->status_order = null;
        $this->total_harga = null;
        $this->tanggal_order = null;
        $this->keterangan = null;
        $this->id_tipe_pembayaran = null;
    }

    public function changeSupplier($id_supplier)
    {
        $this->id_supplier = $id_supplier;
    }

    public function changeStatusOrder($status_order)
    {
        $this->status_order = $status_order;
    }

    public function changeTipePembayaran($id_tipe_pembayaran)
    {
        $this->id_tipe_pembayaran = $id_tipe_pembayaran;
    }

    public function setDataSupplierOrder($id_supplier_order)
    {
        $supplierOrder = SupplierOrder::find($id_supplier_order);
        if (!$supplierOrder) {
            $message = 'Data Supplier Order tidak ditemukan';

            return session()->flash('fail', $message);
        }

        $this->id_supplier_order = $supplierOrder->id;
        $this->id_supplier = $supplierOrder->id_supplier;
        $this->status_order = $supplierOrder->status_order;
        $this->tanggal_order = $supplierOrder->tanggal_order;
        $this->keterangan = $supplierOrder->keterangan;
        $this->id_tipe_pembayaran = $supplierOrder->id_tipe_pembayaran;
    }


}
