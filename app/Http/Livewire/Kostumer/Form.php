<?php

namespace App\Http\Livewire\Kostumer;

use App\Http\Controllers\HelperController;
use App\Models\BarangCustomer;
use App\Models\CustomerSales;
use App\Models\Kostumer;
use App\Models\Sales;
use Livewire\Component;

class Form extends Component
{
    public $listeners = ['setDataKostumer', 'changeSales'];
    public $id_kostumer;
    public $nama;
    public $email;
    public $alamat;
    public $status;
    public $id_barang_customer;
    public $ppn;
    public $no_hp_1;
    public $no_hp_2;
    public $telp_1;
    public $telp_2;
    public $list_id_sales = [];
    public $listBarangCustomer = [];
    public $listSales;
    public $pic;

    public $barang_customer;

    public function render()
    {
        $this->dispatchBrowserEvent('contentChange');
        return view('livewire.kostumer.form');
    }

    public function mount()
    {
        $this->listBarangCustomer = BarangCustomer::get();
        $this->listSales = Sales::get();
    }

    public function simpanDataKostumer()
    {
        $this->validate([
            'nama' => 'required|string',
            'email' => 'required|email',
            // 'no_hp' => 'required|numeric|digits_between:11,12',
            'alamat' => 'required|string',
            'barang_customer' => 'nullable|string',
            'ppn' => 'required|numeric',
            'pic' => 'nullable|string'
        ], [
            'nama.required' => 'Nama tidak boleh kosong',
            'nama.string' => 'Nama tidak valid !',
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Email tidak valid !',
            // 'no_hp.required' => 'Nomor Hp harus diisi',
            // 'no_hp.numeric' => 'Nomor Hp tidak valid !',
            // 'no_hp.digits_between' => 'Nomor HP tidak sesuai ketentuan !',
            'alamat.required' => 'Alamat tidak boleh kosong',
            'alamat.string' => 'Alamat tidak valid !',
            'barang_customer.string' => 'Barang customer tidak valid !',
            'ppn.required' => "PPN tidak boleh kosong",
            'ppn.numeric' => 'PPN tidak valid !',
            'pic.string' => 'PIC tidak valid !'
        ]);

        $customer = Kostumer::updateOrCreate([
            'id' => $this->id_kostumer,
        ], [
            'nama' => $this->nama,
            'email' => $this->email,
            'alamat' => $this->alamat,
            'status' => $this->status ? 1 : 0,
            'id_barang_customer' => $this->id_barang_customer,
            'barang_customer' => $this->barang_customer,
            'ppn' => $this->ppn,
            'no_hp_1' => $this->no_hp_1,
            'no_hp_2' => $this->no_hp_2,
            'telp_1' => $this->telp_1,
            'telp_2' => $this->telp_2,
            'pic' => $this->pic,
        ]);

        CustomerSales::where('id_customer', $customer->id)->delete();
        foreach ($this->list_id_sales as $item) {
            CustomerSales::create([
                'id_sales' => $item,
                'id_customer' => $customer->id
            ]);
        }

        $message = 'Berhasil menyimpan data customer';
        activity()->causedBy(HelperController::user())->log("Menyimpan data customer");
        $this->resetInputFields();
        $this->emit('finishSimpanData', 1, $message);
        $this->emit('refreshDataKostumer');

        return session()->flash('success', $message);
    }

    public function resetInputFields()
    {
        $this->id_kostumer = null;
        $this->nama = null;
        $this->email = null;
        $this->alamat = null;
        $this->status = null;
        $this->id_barang_customer = null;
        $this->barang_customer = null;
        $this->ppn = null;
        $this->no_hp_1 = null;
        $this->no_hp_2 = null;
        $this->telp_1 = null;
        $this->telp_2 = null;
        $this->pic = null;
        $this->list_id_sales = [];
    }

    public function setDataKostumer($id)
    {
        $kostumer = Kostumer::find($id);
        if (!$kostumer) {
            $message = 'Data Customer tidak ditemukan';
            $this->emit('finishDataKostumer', 0, $message);

            return session()->flash('fail', $message);
        }

        $this->id_kostumer = $kostumer->id;
        $this->nama = $kostumer->nama;
        $this->email = $kostumer->email;
        $this->status = $kostumer->status;
        $this->alamat = $kostumer->alamat;
        $this->id_barang_customer = $kostumer->id_barang_customer;
        $this->barang_customer = $kostumer->barang_customer;
        $this->ppn = $kostumer->ppn;
        $this->no_hp_1 = $kostumer->no_hp_1;
        $this->no_hp_2 = $kostumer->no_hp_2;
        $this->telp_1 = $kostumer->telp_1;
        $this->telp_2 = $kostumer->telp_2;
        $this->pic = $kostumer->pic;

        $this->list_id_sales = [];
        foreach ($kostumer->customerSales as $item) {
            array_push($this->list_id_sales, $item->id_sales);
        }
    }

    public function changeSales($list_id_sales){
        $this->list_id_sales = $list_id_sales;
    }
}
