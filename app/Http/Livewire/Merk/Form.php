<?php

namespace App\Http\Livewire\Merk;

use App\Models\Merk;
use Livewire\Component;

class Form extends Component
{
    public $listeners = ['simpanDataMerk', 'setDataMerk'];
    public $id_merk;
    public $nama_merk;
    public function render()
    {
        return view('livewire.merk.form');
    }

    public function mount(){

    }

    public function simpanDataMerk(){
        $this->validate([
            'nama_merk' => 'required|string'
        ], [
            'nama_merk.required' => 'Nama merk tidak boleh kosong',
            'nama_merk.string' => 'Nama merk tidak valid'
        ]);

        Merk::updateOrCreate([
            'id' => $this->id_merk
        ], [
            'nama_merk' => $this->nama_merk
        ]);

        $message = 'Merk berhasil di simpan';
        $this->resetInputFields();
        $this->emit('refreshDataMerk');
        $this->emit('finishSimpanData', 1, $message);

        return session()->flash('success', $message);
    }

    public function resetInputFields(){
        $this->id_merk = null;
        $this->nama_merk = null;
    }

    public function setDataMerk($id){
        $merk = Merk::find($id);
        if(!$merk){
            $message = "Data Merk tidak ditemukan";
            $this->emit('finishDataMerk', 0, $message);
            return session()->flash('fail', $message);
        }

        $this->id_merk = $merk->id;
        $this->nama_merk = $merk->nama_merk;
    }
}
