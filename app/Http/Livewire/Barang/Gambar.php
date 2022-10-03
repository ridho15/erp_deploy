<?php

namespace App\Http\Livewire\Barang;

use App\Models\BarangGambar;
use Livewire\Component;
use Livewire\WithFileUploads;

class Gambar extends Component
{
    use WithFileUploads;
    public $listeners = ['refreshDataBarang' => '$refresh' ,'simpanDataGambar'];
    public $id_barang;
    public $listBarangGambar;
    public $file;
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
            'file' => 'required|max:10240',
            // 'file.*' => 'required|mimes:jpg,png,jpeg,gif,svg|max:10240'
        ], [
            'file.required' => 'File tidak boleh kosong',
            'file.mimes' => 'File tidak valid !',
            // 'file.*.required' => "File tidak boleh kosong",
            // 'file.*.mimes' => 'File tidak valid !',
            // 'file.*.max' => 'File terlalu besar',
            'file.max' => 'File terlalu besar'
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
        $this->resetInputFields();
        $this->emit('finishDataBarang', 1, $message);
        return session()->flash('success', $message);
    }

    public function resetInputFields(){
        $this->file = null;
    }
}
