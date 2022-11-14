<?php

namespace App\Http\Livewire\PreOrder;

use App\Models\Customer;
use App\Models\MetodePembayaran;
use App\Models\PreOrder;
use App\Models\PreOrderDetail;
use App\Models\PreOrderLog;
use App\Models\Quotation;
use App\Models\QuotationDetail;
use App\Models\TipePembayaran;
use Livewire\Component;
use Livewire\WithFileUploads;

class Form extends Component
{
    use WithFileUploads;
    public $listeners = [
        'simpanDataPreOrder',
        'setDataPreOrder',
        'changeKeterangan',
        'hapusFile'
    ];
    public $id_pre_order;
    public $id_quotation;
    public $status;
    public $id_tipe_pembayaran;
    public $id_user;
    public $id_customer;
    public $keterangan;
    public $id_metode_pembayaran;
    public $file;

    public $listQuotation = [];
    public $listTipePembayaran = [];
    public $listCustomer = [];
    public $listMetodePembayaran = [];

    public function render()
    {
        $this->listTipePembayaran = TipePembayaran::get();
        $this->listQuotation = Quotation::where('status', 0)
            ->where('id_customer', $this->id_customer)->get();
        $this->listCustomer = Customer::get();
        $this->listMetodePembayaran = MetodePembayaran::get();

        if($this->id_quotation){
            $quotation = Quotation::find($this->id_quotation);
            if($quotation && $quotation->customer){
                $this->id_customer = $quotation->id_customer;
            }
        }
        $this->dispatchBrowserEvent('contentChange');
        return view('livewire.pre-order.form');
    }

    public function mount(){

    }

    public function simpanDataPreOrder(){
        $this->validate([
            'id_quotation' => 'nullable|numeric',
            'id_tipe_pembayaran' => 'required|numeric',
            'id_customer' => 'required|numeric',
            'keterangan' => 'nullable|string',
        ], [
            'id_quotation.numeric' => 'Quotation tidak valid !',
            'id_customer.required' => 'Customer belum dipilih !',
            'id_customer.numeric' => 'Customer tidak valid !',
            'id_tipe_pembayaran.required' => 'Tipe Pembayaran belum dipilih',
            'id_tipe_pembayaran.numeric' => 'Tipe pembayaran tidak valid !',
            'keterangan.string' => 'Keterangan tidak valid !'
        ]);

        if($this->id_quotation){
            $quotation = Quotation::find($this->id_quotation);
            if(!$quotation){
                $message = "Data quotation tidak ditemukan !";
                return session()->flash('fail', $message);
            }
        }

        // Check tipe pembayaran
        $tipePembayaran = TipePembayaran::find($this->id_tipe_pembayaran);
        if(!$tipePembayaran){
            $message = "Data Tipe pembayaran tidak ditemukan !";
            return session()->flash('fail', $message);
        }

        // Check Data Customer
        $customer = Customer::find($this->id_customer);
        if(!$customer){
            $message = "Data customer tidak ditemukan !";
            return session()->flash('fail', $message);
        }

        $data['id_quotation'] = $this->id_quotation;
        $data['id_tipe_pembayaran'] = $this->id_tipe_pembayaran;
        $data['status'] = 1;
        $data['id_user'] = session()->get('id_user');
        $data['id_customer'] = $this->id_customer;
        $data['keterangan'] = $this->keterangan;
        $data['id_metode_pembayaran'] = $this->id_metode_pembayaran;

        if($this->file){
            $path = $this->file->store('public/pre-order');
            $path = str_replace('public', '', $path);
            $data['file'] = $path;
        }

        $preOrder = PreOrder::updateOrCreate([
            'id' => $this->id_pre_order
        ], $data);

        if($this->id_quotation && $this->id_pre_order == null){
            $listQuotationDetail = QuotationDetail::where('id_quotation', $this->id_quotation)->get();
            foreach ($listQuotationDetail as $item) {
                PreOrderDetail::create([
                    'id_pre_order' => $preOrder->id,
                    'id_barang' => $item->id_barang,
                    'harga' => $item->harga,
                    'qty' => $item->qty,
                    'id_satuan' => $item->id_satuan,
                    'keterangan' => $item->deskripsi
                ]);
            }
        }

        PreOrderLog::create([
            'id_pre_order' => $preOrder->id,
            'tanggal' => now(),
            'status' => 1
        ]);
        $message = "Berhasil menyimpan data";
        $this->resetInputFields();
        $this->emit('refreshPreOrder');
        $this->emit('finishSimpanData', 1, $message);
        return session()->flash('success', $message);
    }

    public function resetInputFields(){
        $this->id_pre_order = null;
        $this->id_quotation = null;
        $this->id_tipe_pembayaran = null;
        $this->status = null;
        $this->id_user = null;
        $this->id_customer = null;
        $this->keterangan = null;
        $this->id_metode_pembayaran = null;
    }

    public function changeKeterangan($keterangan){
        $this->keterangan = $keterangan;
    }

    public function setDataPreOrder($id){
        $preOrder = PreOrder::find($id);
        if(!$preOrder){
            $message = "Data Pre Order tidak ditemukan !";
            $this->emit('refreshData', 0, $message);
            return session()->flash('fail', $message);
        }

        $this->id_pre_order = $preOrder->id;
        $this->id_quotation = $preOrder->id_quotation;
        $this->id_customer = $preOrder->id_customer;
        $this->id_tipe_pembayaran = $preOrder->id_tipe_pembayaran;
        $this->id_metode_pembayaran = $preOrder->id_metode_pembayaran;
        $this->keterangan = $preOrder->keterangan;
    }

    public function hapusFile(){
        $this->file = null;
    }
}
