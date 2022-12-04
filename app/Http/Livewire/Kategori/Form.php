<?php

namespace App\Http\Livewire\Kategori;

use App\Http\Controllers\HelperController;
use App\Models\Kategori;
use Livewire\Component;

class Form extends Component
{
    public $listeners = ['setDataKategori', 'simpanDataKategori'];
    public $id_kategori;
    public $nama_kategori;
    public function render()
    {
        return view('livewire.kategori.form');
    }

    public function mount(){

    }

    public function simpanDataKategori(){
        $this->validate([
            'nama_kategori' => 'required|string'
        ], [
            'nama_kategori.required' => 'Nama kategori tidak boleh kosong',
            'nama_kategori.string' => 'Nama kategori tidak valid !'
        ]);

        Kategori::updateOrCreate([
            'id' => $this->id_kategori,
        ], [
            'nama_kategori' => $this->nama_kategori
        ]);

        $message = 'Berhasil menyimpan data';
        activity()->causedBy(HelperController::user())->log("Menambah / mengupdate data kategori");
        $this->resetInputFields();
        $this->emit('refreshDataKategori');
        $this->emit('finishSimpanData', 1, $message);

        return session()->flash('success', $message);
    }

    public function resetInputFields(){
        $this->id_kategori = null;
        $this->nama_kategori = null;
    }

    public function setDataKategori($id_kategori){
        $kategori = Kategori::find($id_kategori);
        if(!$kategori){
            $message = "Kategori tidak ditemukan";
            $this->emit('finishDataKategori', 0, $message);
            return session()->flash('fail', $message);
        }

        $this->id_kategori = $kategori->id;
        $this->nama_kategori = $kategori->nama_kategori;
    }
}
