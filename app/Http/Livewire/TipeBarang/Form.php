<?php

namespace App\Http\Livewire\TipeBarang;

use App\Models\TipeBarang;
use Livewire\Component;

class Form extends Component
{
    public $listeners = ['simpanTipeBarang', 'setDataTipeBarang'];
    public $tipe_barang;
    public $id_tipe_barang;
    public function render()
    {
        return view('livewire.tipe-barang.form');
    }

    public function mount(){

    }

    public function simpanTipeBarang(){
        $this->validate([
            'tipe_barang' => 'required|string'
        ], [
            'tipe_barang.required' => 'Nama tipe barang tidak boleh kosong',
            'tipe_barang.string' => 'Nama tipe barang tidak valid !'
        ]);

        TipeBarang::updateOrCreate([
            'id' => $this->id_tipe_barang
        ], [
            'tipe_barang' => $this->tipe_barang
        ]);

        $message = "Berhasil menyimpan data tipe barang";
        $this->resetInputFields();
        $this->emit('refreshTipeBarang');
        $this->emit('finishSimpanData', 1, $message);
        return session()->flash('success', $message);
    }

    public function resetInputFields(){
        $this->id_tipe_barang = null;
        $this->tipe_barang = null;
    }

    public function setDataTipeBarang($id){
        $tipeBarang = TipeBarang::find($id);
        if(!$tipeBarang){
            $message = "Tipe barang tidak ditemukan";

            return session()->flash('fail', $message);
        }

        $this->id_tipe_barang = $tipeBarang->id;
        $this->tipe_barang = $tipeBarang->tipe_barang;
    }
}
