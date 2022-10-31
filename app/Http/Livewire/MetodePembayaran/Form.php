<?php

namespace App\Http\Livewire\MetodePembayaran;

use App\Models\MetodePembayaran;
use Livewire\Component;

class Form extends Component
{
    public $listeners = ['setMetodePembayaran', 'simpanMetodePembayaran'];
    public $id_metode_pembayaran;
    public $nama_metode;
    public $nilai;
    public function render()
    {
        return view('livewire.metode-pembayaran.form');
    }

    public function setMetodePembayaran($id_metode_pembayaran){
        $metodePembayaran = MetodePembayaran::find($id_metode_pembayaran);
        if(!$metodePembayaran){
            $message = "Metode pembayaran tidak ditemukan";
            return session()->flash('fail', $message);
        }

        $this->id_metode_pembayaran = $metodePembayaran->id;
        $this->nama_metode = $metodePembayaran->nama_metode;
        $this->nilai = $metodePembayaran->nilai;
    }

    public function simpanMetodePembayaran(){
        $this->validate([
            'nama_metode' => 'required|string',
            'nilai' => 'required|numeric'
        ], [
            'nama_metode.required' => 'Nama Metode Pembayaran tidak boleh kosong',
            'nama_metode.string' => 'Nama Metode Pembayaran tidak valid !',
            'nilai.required' => 'Jangka waktu tidak boleh kosong',
            'nilai.numeric' => 'Jangka waktu tidak valid !',
        ]);

        MetodePembayaran::updateOrCreate([
            'id' => $this->id_metode_pembayaran
        ], [
            'nama_metode' => $this->nama_metode,
            'nilai' => $this->nilai
        ]);

        $message = "Berhasil menyimpan metode pembayaran";
        $this->resetInputFields();
        $this->emit('refreshMetodePembayaran');
        $this->emit('finishSimpanData', 1, $message);
        return session()->flash('success', $message);
    }

    public function resetInputFields(){
        $this->id_metode_pembayaran = null;
        $this->nama_metode = null;
        $this->nilai = null;
    }
}
