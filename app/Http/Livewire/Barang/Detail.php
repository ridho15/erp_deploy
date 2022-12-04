<?php

namespace App\Http\Livewire\Barang;

use App\Http\Controllers\HelperController;
use App\Models\Barang;
use App\Models\BarangKategori;
use Livewire\Component;

class Detail extends Component
{
    public $listeners = ['refreshDataBarang' => '$refresh','hapusKategoriBarang'];
    public $id_barang;
    public $barang;
    public function render()
    {
        $this->barang = Barang::find($this->id_barang);
        return view('livewire.barang.detail');
    }

    public function mount($id_barang){
        $this->id_barang = $id_barang;
    }

    public function hapusKategoriBarang($id){
        $barangKategori = BarangKategori::find($id);
        if(!$barangKategori){
            $message = "Barang Kategori tidak ditemukan";
            return session()->flash('fail', $message);
        }

        $barangKategori->delete();
        $message = "Barang kategori berhasil di hapus";
        activity()->causedBy(HelperController::user())->log("Menghapus barang kategori");
        return session()->flash('success', $message);
    }
}
