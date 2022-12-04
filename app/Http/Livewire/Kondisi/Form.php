<?php

namespace App\Http\Livewire\Kondisi;

use App\Http\Controllers\HelperController;
use App\Models\Kondisi;
use Livewire\Component;

class Form extends Component
{
    public $listeners = ['simpanKondisi', 'setKondisi'];
    public $id_kondisi;
    public $kode;
    public $keterangan;
    public function render()
    {
        return view('livewire.kondisi.form');
    }

    public function simpanKondisi(){
        $this->validate([
            'kode' => 'required|string',
            'keterangan' => 'required|string'
        ], [
            'kode.required' => 'Kode tidak boleh kosong',
            'kode.string' => 'Kode tidak valid !',
            'keterangan.required' => 'Keterangan tidak boleh kosong',
            'keterangan.string' => 'Keterangan tidak valid !'
        ]);

        Kondisi::updateOrCreate([
            'id' => $this->id_kondisi
        ], [
            'kode' => $this->kode,
            'keterangan' => $this->keterangan
        ]);
         $message = "Berhasil menyimpan data kondisi";
         activity()->causedBy(HelperController::user())->log("Menambah / menyimpan data kondisi");
         $this->resetInputFields();
         $this->emit('refreshKondisi');
         $this->emit('finishSimpanData', 1, $message);
         return session()->flash('success', $message);
    }

    public function resetInputFields(){
        $this->id_kondisi = null;
        $this->kode = null;
        $this->keterangan = null;
    }

    public function setKondisi($id){
        $kondisi = Kondisi::find($id);
        if(!$kondisi){
            $message = "Data Kondisi tidak ditemukan";
            return session()->flash('fail', $message);
        }

        $this->id_kondisi = $kondisi->id;
        $this->kode = $kondisi->kode;
        $this->keterangan = $kondisi->keterangan;
    }
}
