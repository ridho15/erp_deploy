<?php

namespace App\Http\Livewire\TipePembayaran;

use App\Models\TipePembayaran;
use Livewire\Component;

class Form extends Component
{
    public $listeners = ['setDataUser', 'simpanDataUser'];
    public $id_user;
    public $name;
    public $listTipeUser;

    public function render()
    {
        $this->listTipeUser = TipePembayaran::get();
        $this->dispatchBrowserEvent('contentChange');

        return view('livewire.tipe-pembayaran.form');
    }

    public function mount()
    {
    }

    public function setDataUser($id)
    {
        $user = TipePembayaran::find($id);
        if (!$user) {
            $message = 'Data tidak ditemukan';
            $this->emit('finishDataUser', 0, $message);
        }

        $this->id_user = $user->id;
        $this->name = $user->nama_tipe;
    }

    public function simpanDataUser()
    {
        $this->validate([
            'name' => 'required|string',
        ], [
            'name.required' => 'Nama tipe tidak boleh kosong',
        ]);

        $data['nama_tipe'] = $this->name;
        TipePembayaran::updateOrCreate([
            'id' => $this->id_user,
        ], $data);

        $message = 'Berhasil manambahkan Tipe Pembayaran';
        $this->emit('refreshUser');
        $this->resetInputFields();

        return $this->emit('finishSimpanData', 1, $message);
    }

    public function resetInputFields()
    {
        $this->id_user = null;
        $this->name = null;
    }
}
