<?php

namespace App\Http\Livewire\Pekerjaan;

use App\Models\Pekerjaan;
use Livewire\Component;

class Form extends Component
{
    public $listeners = ['simpanKondisi', 'setKondisi'];
    public $id_kondisi;
    public $kode;
    public $keterangan;

    public function render()
    {
        return view('livewire.pekerjaan.form');
    }

    public function simpanKondisi()
    {
        $this->validate([
            'kode' => 'required|string',
            'keterangan' => 'required|string',
        ], [
            'kode.required' => 'Kode tidak boleh kosong',
            'kode.string' => 'Kode tidak valid !',
            'keterangan.required' => 'Keterangan tidak boleh kosong',
            'keterangan.string' => 'Keterangan tidak valid !',
        ]);

        Pekerjaan::updateOrCreate([
            'id' => $this->id_kondisi,
        ], [
            'kode' => $this->kode,
            'keterangan' => $this->keterangan,
        ]);
        $message = 'Berhasil menyimpan data kondisi';
        $this->resetInputFields();
        $this->emit('refreshKondisi');
        $this->emit('finishSimpanData', 1, $message);

        return session()->flash('success', $message);
    }

    public function resetInputFields()
    {
        $this->id_kondisi = null;
        $this->kode = null;
        $this->keterangan = null;
    }

    public function setKondisi($id)
    {
        $kondisi = Pekerjaan::find($id);
        if (!$kondisi) {
            $message = 'Data Kondisi tidak ditemukan';

            return session()->flash('fail', $message);
        }

        $this->id_kondisi = $kondisi->id;
        $this->kode = $kondisi->kode;
        $this->keterangan = $kondisi->keterangan;
    }
}
