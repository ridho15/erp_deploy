<?php

namespace App\Http\Livewire\Profil;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Data extends Component
{
    use WithPagination;
    public $paginationTheme = 'bootstrap';
    public $listeners = ['simpanProfile', 'refreshProfile' => '$refresh'];
    public $total_show = 10;
    public $cari;

    public $id_user;
    public $name;
    public $username;
    public $phone;
    public $email;
    public $foto;
    protected $profile;

    public function render()
    {
        return view('livewire.profil.data');
    }

    public function mount()
    {
        $this->profile = User::find(session()->get('id_user'));
        $this->setProfile();
    }

    public function setProfile()
    {
        $this->id_user = $this->profile->id;
        $this->name = $this->profile->name;
        $this->username = $this->profile->username;
        $this->phone = $this->profile->phone;
        $this->email = $this->profile->email;
        $this->foto = $this->profile->foto;
    }

    public function simpanProfile()
    {
        $this->validate([
            'username' => 'required',
            'phone' => 'required|numeric',
            'email' => 'nullable|email',
            'name' => 'required',
        ], [
            'username.required' => 'Username belum diisi !',
            'phone.required' => 'Nomor Handphone diperlukan !',
            'phone.numeric' => 'Nomor Handphone tidak valid !',
            'email.email' => 'Format email tidak valid!',
            'name.required' => 'Mohon isi nama Anda !',
        ]);

        $data['username'] = $this->username;
        $data['phone'] = $this->phone;
        $data['email'] = $this->email;
        $data['name'] = $this->name;
        $data['foto'] = $this->foto;

        User::updateOrCreate([
            'id' => $this->id_user,
        ], $data);

        $message = 'Berhasil mengubah profil';
        $this->emit('refreshProfile');
        $this->emit('finishSimpanData', 1, $message);
        $this->emit('finishRefreshData', 1, $message);

        return session()->flash('success', $message);
    }
}
