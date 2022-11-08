<?php

namespace App\Http\Livewire\Pekerjaan;

use App\Models\Pekerjaan;
use Livewire\Component;

class Form extends Component
{
    public $listeners = ['simpanPekerjaan', 'setPekerjaan'];
    public $id_pekerjaan;
    public $kode;
    public $keterangan;

    public function render()
    {
        return view('livewire.pekerjaan.form');
    }

    public function simpanPekerjaan()
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
            'id' => $this->id_pekerjaan,
        ], [
            'kode' => $this->kode,
            'keterangan' => $this->keterangan,
        ]);
        $message = 'Berhasil menyimpan data pekerjaan';
        $this->resetInputFields();
        $this->emit('refreshPekerjaan');
        $this->emit('finishSimpanData', 1, $message);

        return session()->flash('success', $message);
    }

    public function resetInputFields()
    {
        $this->id_pekerjaan = null;
        $this->kode = null;
        $this->keterangan = null;
    }

    public function setPekerjaan($id)
    {
        $pekerjaan = Pekerjaan::find($id);
        if (!$pekerjaan) {
            $message = 'Data pekerjaan tidak ditemukan';

            return session()->flash('fail', $message);
        }

        $this->id_pekerjaan = $pekerjaan->id;
        $this->kode = $pekerjaan->kode;
        $this->keterangan = $pekerjaan->keterangan;
    }
}
