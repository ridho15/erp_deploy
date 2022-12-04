<?php

namespace App\Http\Livewire\Barang;

use App\Http\Controllers\HelperController;
use App\Models\BarangGambar;
use Livewire\Component;
use Livewire\WithFileUploads;

class Gambar extends Component
{
    use WithFileUploads;
    public $listeners = [
        'refreshDataBarang' => '$refresh',
        'simpanDataGambar',
        'hapusGambar'
    ];
    public $id_barang;
    public $listBarangGambar;
    public $file = [];
    public function render()
    {
        $this->listBarangGambar = BarangGambar::where('id_barang', $this->id_barang)->get();
        return view('livewire.barang.gambar');
    }

    public function mount($id_barang){
        $this->id_barang = $id_barang;
    }

    public function simpanDataGambar(){
        $this->validate([
            'file.*' => 'required|mimes:jpg,png,jpeg,gif,svg|max:10240'
        ]);

        if($this->file){
            foreach ($this->file as $item) {
                $path = $item->store('public/asset/barang');
                $path = str_replace('public', '', $path);
                BarangGambar::create([
                    'id_barang' => $this->id_barang,
                    'file' => $path
                ]);
            }
        }

        $message = "Berhasil mengupload gambar";
        activity()->causedBy(HelperController::user())->log("Mengupload data gambar");
        $this->resetInputFields();
        $this->emit('finishDataBarang', 1, $message);
        return session()->flash('success', $message);
    }

    public function resetInputFields(){
        $this->file = null;
    }

    public function hapusGambar($id){
        $barangGambar = BarangGambar::find($id);
        if(!$barangGambar){
            $message = "Gambar tidak ditemukan !";

            return session()->flash('fail', $message);
        }

        $barangGambar->delete();
        $message = "Gambar berhasil di hapus";
        activity()->causedBy(HelperController::user())->log("Menghapus data gambar barang");
        return session()->flash('success', $message);
    }
}
