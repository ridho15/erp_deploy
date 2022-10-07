<?php

namespace App\Http\Livewire\Kostumer;

use App\Models\Kostumer;
use Livewire\Component;

class Form extends Component
{
    public $listeners = ['setDataKostumer'];
    public $id_kostumer;
    public $nama;
    public $email;
    public $no_hp;
    public $alamat;
    public $status;

    public function render()
    {
        return view('livewire.kostumer.form');
    }

    public function mount()
    {
    }

    public function simpanDataKostumer()
    {
        $this->validate([
            'nama' => 'required|string',
            'email' => 'required|email',
            'no_hp' => 'required|numeric|digits_between:11,12',
            'alamat' => 'required|string',
        ], [
            'nama.required' => 'Nama tidak boleh kosong',
            'nama.string' => 'Nama tidak valid !',
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Email tidak valid !',
            'no_hp.required' => 'Nomor Hp harus diisi',
            'no_hp.numeric' => 'Nomor Hp tidak valid !',
            'no_hp.digits_between' => 'Nomor HP tidak sesuai ketentuan !',
            'alamat.required' => 'Alamat tidak boleh kosong',
            'alamat.string' => 'Alamat tidak valid !',
        ]);

        Kostumer::updateOrCreate([
            'id' => $this->id_kostumer,
        ], [
            'nama' => $this->nama,
            'email' => $this->email,
            'no_hp' => $this->no_hp,
            'alamat' => $this->alamat,
            'status' => $this->status ? 1 : 0,
        ]);

        $message = 'Berhasil menyimpan data customer';
        $this->resetInputFields();
        $this->emit('finishSimpanData', 1, $message);
        $this->emit('refreshDataKostumer');

        return session()->flash('success', $message);
    }

    public function resetInputFields()
    {
        $this->id_kostumer = null;
        $this->nama = null;
        $this->email = null;
        $this->no_hp = null;
        $this->alamat = null;
        $this->status = null;
    }

    public function setDataKostumer($id)
    {
        $kostumer = Kostumer::find($id);
        if (!$kostumer) {
            $message = 'Data Customer tidak ditemukan';
            $this->emit('finishDataKostumer', 0, $message);

            return session()->flash('fail', $message);
        }

        $this->id_kostumer = $kostumer->id;
        $this->nama = $kostumer->nama;
        $this->no_hp = $kostumer->no_hp;
        $this->email = $kostumer->email;
        $this->status = $kostumer->status;
        $this->alamat = $kostumer->alamat;
    }
}
