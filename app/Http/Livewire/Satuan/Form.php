<?php

namespace App\Http\Livewire\Satuan;

use App\Models\Satuan;
use Livewire\Component;

class Form extends Component
{
    public $listeners = ['setDataUser', 'simpanDataUser'];
    public $id_user;
    public $nilai;
    public $name;
    public $listTipeUser;

    public function render()
    {
        $this->listTipeUser = Satuan::get();
        $this->dispatchBrowserEvent('contentChange');

        return view('livewire.satuan.form');
    }

    public function mount()
    {
    }

    public function setDataUser($id)
    {
        $user = Satuan::find($id);
        if (!$user) {
            $message = 'Data tidak ditemukan';
            $this->emit('finishDataUser', 0, $message);
        }

        $this->id_user = $user->id;
        $this->name = $user->nama_satuan;
        $this->nilai = $user->nilai;
    }

    public function simpanDataUser()
    {
        $this->validate([
            'name' => 'required|string',
            'nilai' => 'required',
        ], [
            'name.required' => 'Nama tipe tidak boleh kosong',
            'nilai.required' => 'Nilai tipe tidak boleh kosong',
        ]);

        $data['nama_satuan'] = $this->name;
        $data['nilai'] = $this->nilai;
        Satuan::updateOrCreate([
            'id' => $this->id_user,
        ], $data);

        $message = 'Berhasil manambahkan Satuan';
        $this->emit('refreshUser');
        $this->resetInputFields();

        return $this->emit('finishSimpanData', 1, $message);
    }

    public function resetInputFields()
    {
        $this->id_user = null;
        $this->name = null;
        $this->nilai = null;
    }
}
