<?php

namespace App\Http\Livewire\Kategori;

use App\Http\Controllers\HelperController;
use App\Models\Barang;
use App\Models\BarangKategori;
use App\Models\Kategori;
use Livewire\Component;

class TambahBarangKategori extends Component
{
    public $listeners = ['simpanDataKategoriBarang', 'setIdKategori', 'setIdBarang'];
    public $id_kategori;
    public $id_barang;
    public $listBarang;
    public $listKategori;
    public function render()
    {
        $this->listBarang = Barang::get();
        $this->listKategori = Kategori::get();

        $this->dispatchBrowserEvent('contentChange');
        return view('livewire.kategori.tambah-barang-kategori');
    }

    public function mount(){

    }

    public function setIdKategori($id_kategori){
        $this->id_kategori = $id_kategori;
    }

    public function setIdBarang($id_barang){
        $this->id_barang = $id_barang;
    }

    public function simpanDataKategoriBarang(){
        $this->validate([
            'id_barang' => 'required|numeric',
            'id_kategori' => 'required|numeric',
        ], [
            'id_barang.required' => 'Barang belum dipilih',
            'id_barang.numeric' => 'Barang tidak valid !',
            'id_kategori.required' => 'Kategori belum dipilih',
            'id_kategori.numeric' => 'Kategori tidak valid !',
        ]);

        // check barang
        $barang = Barang::find($this->id_barang);
        if(!$barang){
            $message = "Barang tidak ditemukan";
            return session()->flash('fail', $message);
        }

        // Check kategori
        $kategori = Kategori::find($this->id_kategori);
        if(!$kategori){
            $message = "Kategori tidak ditemukan";
            return session()->flash('fail', $message);
        }

        // check kategori barang sudah ada atau tidak
        $barangKategori = BarangKategori::where('id_barang', $this->id_barang)
        ->where('id_kategori', $this->id_kategori)->first();
        if($barangKategori){
            $message = "Barang Kategori Sudah terpasang";

            return session()->flash('fail', $message);
        }

        BarangKategori::create([
            'id_barang' => $this->id_barang,
            'id_kategori' => $this->id_kategori
        ]);

        $message = "Berhasil menyimpan data";
        activity()->causedBy(HelperController::user())->log("Menambah / mengupdate data kategori barang");
        $this->resetInputFields();
        $this->emit('refreshDataKategori');
        $this->emit('refreshDataBarang');
        $this->emit('finishSimpanData', 1, $message);

        return session()->flash('success', $message);
    }

    public function resetInputFields(){
        $this->id_barang = null;
        $this->id_kategori = null;
    }
}
