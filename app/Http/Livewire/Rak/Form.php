<?php

namespace App\Http\Livewire\Rak;

use App\Http\Controllers\HelperController;
use App\Models\Rak;
use Livewire\Component;

class Form extends Component
{
    public $listeners = [
        'simpanRak',
        'setRak'
    ];
    public $id_rak;
    public $kode_rak;
    public $nama_rak;
    public $warna_rak;
    public function render()
    {
        $this->dispatchBrowserEvent('contentChange');
        return view('livewire.rak.form');
    }

    public function simpanRak(){
        $this->validate([
            'kode_rak' => 'required|string',
            'nama_rak' => 'required|string',
            'warna_rak' => 'nullable|string',
        ], [
            'kode_rak.required' => 'Kode rak tidak boleh kosong',
            'kode_rak.string' => 'Kode rak tidak valid !',
            'nama_rak.required' => 'Nama rak tidak boleh kosong',
            'nama_rak.string' => 'Nama rak tidak valid !',
            'warna_rak.string' => 'Warna rak tidak valid !'
        ]);

        Rak::updateOrCreate([
            'id' => $this->id_rak,
        ],[
            'kode_rak' => $this->kode_rak,
            'nama_rak' => $this->nama_rak,
            'warna_rak' => $this->warna_rak
        ]);

        $message = "Berhasil menyimpan data rak";
        activity()->causedBy(HelperController::user())->log("Menambah / mengedit data rak");
        $this->resetInputFields();
        $this->emit('refreshRak');
        $this->emit('finishSimpanData', 1, $message);
        return session()->flash('success', $message);
    }

    public function setRak($id){
        $rak = Rak::find($id);
        if(!$rak){
            $message = "Data rak tidak ditemukan !";
            return session()->flash('fail', $message);
        }

        $this->id_rak = $rak->id;
        $this->kode_rak = $rak->kode_rak;
        $this->nama_rak = $rak->nama_rak;
        $this->warna_rak = $rak->warna_rak;
    }

    public function resetInputFields(){
        $this->id_rak = null;
        $this->kode_rak = null;
        $this->nama_rak = null;
        $this->warna_rak = null;
    }
}
