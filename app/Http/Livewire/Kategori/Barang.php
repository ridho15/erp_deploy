<?php

namespace App\Http\Livewire\Kategori;

use App\Http\Controllers\HelperController;
use App\Models\BarangKategori;
use Livewire\Component;

class Barang extends Component
{
    public $listeners = ['hapusDataBarangKategori', 'setIdKategori'];
    public $listBarangKategori;
    public $id_kategori;
    public $id_barang;
    public function render()
    {
        $this->listBarangKategori = BarangKategori::where('id_barang', $this->id_barang)
        ->orWhere('id_kategori', $this->id_kategori)->get();
        return view('livewire.kategori.barang');
    }

    public function mount(){

    }

    public function setIdKategori($id_kategori){
        $this->id_kategori = $id_kategori;
    }

    public function hapusDataBarangKategori($id){
        $barangKategori = BarangKategori::find($id);
        if(!$barangKategori){
            $message = "Barang kategori tidak ditemukan";
            return session()->flash('fail', $message);
        }

        $barangKategori->delete();
        $message = "Barang kategori berhasil di hapus";
        activity()->causedBy(HelperController::user())->log("Menghapus barang kategori");

        $this->emit('finishDataKategori', 1, $message);
        return session()->flash('success', $message);
    }
}
