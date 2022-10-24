<?php

namespace App\Http\Livewire\Profil;

use App\CPU\Helpers;
use App\Models\User;
use App\Models\UserLog;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Data extends Component
{
    use WithPagination;
    use WithFileUploads;
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
    public $fotoView;
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
        $this->fotoView = $this->profile->foto;
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

        $dir = 'profile';
        $data = User::find($this->id_user);
        if (isset($this->foto)) {
            $logo['value'] = $data->foto;

            $imgLogo = Helpers::update('profile/', $logo, 'png', $this->foto);

            $old_image = $logo['value'];

            if ($logo['value'] !== null) {
                if (File::exists(public_path($old_image))) {
                    unlink(public_path($old_image));
                }
            }

            if ($this->foto != null) {
                $imageName = Carbon::now()->toDateString().'-'.uniqid().'.'.'.png';

                if (!Storage::disk('public')->exists($dir)) {
                    Storage::disk('public')->makeDirectory($dir);
                }
                $url = $this->foto->store('storage/'.$dir);
            } else {
                $url = null;
            }
        }

        $data['username'] = $this->username;
        $data['phone'] = $this->phone;
        $data['email'] = $this->email;
        $data['name'] = $this->name;
        $data['foto'] = $url;

        $data->save();

        $message = 'Berhasil mengubah profil';
        $this->emit('refreshProfile');
        $this->emit('finishSimpanData', 1, $message);
        $this->emit('finishRefreshData', 1, $message);

        session()->flash('success', $message);

        return redirect(request()->header('Referer'));
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
