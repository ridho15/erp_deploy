<?php

namespace App\Http\Livewire\Kostumer;

use App\Http\Controllers\HelperController;
use App\Models\BarangCustomer;
use App\Models\Kostumer;
use Livewire\Component;

class Form extends Component
{
    public $listeners = ['setDataKostumer'];
    public $id_kostumer;
    public $nama;
    public $email;
    public $no_hp;
    public $alamat;
    public $status;
    public $id_barang_customer;
    public $ppn;
    public $listBarangCustomer = [];

    public $barang_customer;

    public function render()
    {
        $this->listBarangCustomer = BarangCustomer::get();
        return view('livewire.kostumer.form');
    }

    public function mount()
    {
    }

    public function simpanDataKostumer()
    {
        $this->validate([
            'nama' => 'required|string',
            'email' => 'required|email',
            'no_hp' => 'required|numeric|digits_between:11,12',
            'alamat' => 'required|string',
            'barang_customer' => 'nullable|string',
            'ppn' => 'required|numeric'
        ], [
            'nama.required' => 'Nama tidak boleh kosong',
            'nama.string' => 'Nama tidak valid !',
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Email tidak valid !',
            'no_hp.required' => 'Nomor Hp harus diisi',
            'no_hp.numeric' => 'Nomor Hp tidak valid !',
            'no_hp.digits_between' => 'Nomor HP tidak sesuai ketentuan !',
            'alamat.required' => 'Alamat tidak boleh kosong',
            'alamat.string' => 'Alamat tidak valid !',
            'barang_customer.string' => 'Barang customer tidak valid !',
            'ppn.required' => "PPN tidak boleh kosong",
            'ppn.numeric' => 'PPN tidak valid !'
        ]);

        Kostumer::updateOrCreate([
            'id' => $this->id_kostumer,
        ], [
            'nama' => $this->nama,
            'email' => $this->email,
            'no_hp' => $this->no_hp,
            'alamat' => $this->alamat,
            'status' => $this->status ? 1 : 0,
            'id_barang_customer' => $this->id_barang_customer,
            'barang_customer' => $this->barang_customer,
            'ppn' => $this->ppn
        ]);

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
        $this->no_hp = null;
        $this->alamat = null;
        $this->status = null;
        $this->id_barang_customer = null;
        $this->barang_customer = null;
        $this->ppn = null;
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
        $this->no_hp = $kostumer->no_hp;
        $this->email = $kostumer->email;
        $this->status = $kostumer->status;
        $this->alamat = $kostumer->alamat;
        $this->id_barang_customer = $kostumer->id_barang_customer;
        $this->barang_customer = $kostumer->barang_customer;
        $this->ppn = $kostumer->ppn;
    }
}
