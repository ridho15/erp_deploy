<?php

namespace App\Http\Livewire\Profil;

use App\Models\User;
use App\Models\UserLog;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;

class Data extends Component
{
    use WithPagination;
    public $paginationTheme = 'bootstrap';
    public $listeners = ['simpanProfile', 'refreshProfile' => '$refresh', 'changePassword'];
    public $total_show = 10;
    public $cari;

    public $id_user;
    public $name;
    public $username;
    public $phone;
    public $email;
    public $foto;
    public $oldPassword;
    public $newPassword;
    public $c_newPassword;
    protected $profile;

    public function render()
    {
        return view('livewire.profil.data');
    }

    public function mount()
    {
        $this->profile = User::find(session()->get('id_user'));
        $this->dispatchBrowserEvent('contentChange');
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

    public function resetFields()
    {
        $this->oldPassword = '';
        $this->newPassword = '';
        $this->c_newPassword = '';
    }

    public function changePassword()
    {
        $this->validate([
            'newPassword' => 'min:8',
        ], [
            'newPassword.min' => 'Password minimal 8 Karakter!',
        ]);
        $user = User::where('username', $this->username)->first();

        if (!Hash::check($this->oldPassword, $user->password)) {
            if ($this->newPassword == $this->c_newPassword) {
                $user->password = Hash::make($this->newPassword);
                $user->lastPasswordChange = now();

                UserLog::create([
                    'id_user' => $user->id,
                    'status' => 0,
                    'user_agent' => 'changed password',
                    'lastLogin' => now(),
                    'lastPasswordChange' => now(),
                    'last_ip' => 'unset',
                ]);

                $user->save();
                $message = 'Password berhasil diganti!';
                $this->resetFields();
                $this->emit('finishSimpanData', 1, $message);
            } else {
                $message = 'Konfirmasi password baru tidak sama!';
                $this->emit('finishSimpanData', 2, $message);
            }
        } else {
            $message = 'Password lama salah!';
            $this->resetFields();
            $this->emit('finishSimpanData', 2, $message);
        }
    }
}
