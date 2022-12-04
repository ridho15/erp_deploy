<?php

namespace App\Http\Livewire\BarangCustomer;

use App\Http\Controllers\HelperController;
use App\Models\BarangCustomer;
use Livewire\Component;

class Form extends Component
{
    public $listeners = [
        'simpanBarangCustomer',
        'setBarangCustomer',
    ];

    public $id_barang_customer;
    public $nama_barang;
    public $keterangan;
    public function render()
    {
        return view('livewire.barang-customer.form');
    }

    public function simpanBarangCustomer(){
        $this->validate([
            'nama_barang' => 'required|string',
            'keterangan' => 'nullable|string'
        ], [
            'nama_barang.required' => 'Nama barang tidak boleh kosong',
            'nama_barang.string' => 'Nama barang tidak valid !',
            'keterangan.string' => 'Keterangan tidak valid !'
        ]);

        BarangCustomer::updateOrCreate([
            'id' => $this->id_barang_customer
        ], [
            'nama_barang' => $this->nama_barang,
            'keterangan' => $this->keterangan
        ]);

        $message = "Barang berhasil di simpan";
        activity()->causedBy(HelperController::user())->log("Menyimpan data Barang Customer");
        $this->emit('refreshBarangCustomer');
        $this->emit('finishSimpanData', 1, $message);

        return session()->flash('success', $message);
    }

    public function setBarangCustomer($id){
        $barangCustomer = BarangCustomer::find($id);
        if(!$barangCustomer){
            $message = "Data barang customer tidak ditemukan !";
            return session()->flash('fail', $message);
        }

        $this->id_barang_customer = $barangCustomer->id;
        $this->nama_barang = $barangCustomer->nama_barang;
        $this->keterangan = $barangCustomer->keterangan;
    }
}
