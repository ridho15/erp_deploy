<?php

namespace App\Http\Livewire\Worker;

use App\Models\TipeUser;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Illuminate\Support\Str;

class Form extends Component
{
    public $listeners = ['setDataUser', 'simpanDataUser'];
    public $id_user;
    public $name;
    public $username;
    public $password;
    public $jabatan;
    public $email;
    public $phone;
    public $is_active;
    public $id_tipe_user;
    public $listTipeUser;
    public function render()
    {
        $this->listTipeUser = TipeUser::get();
        $this->dispatchBrowserEvent('contentChange');
        return view('livewire.worker.form');
    }

    public function mount(){

    }

    public function setDataUser($id){
        $user = User::find($id);
        if(!$user){
            $message = "Data tidak ditemukan";
            $this->emit('finishDataUser', 0, $message);
        }

        $this->id_user = $user->id;
        $this->username = $user->username;
        $this->name = $user->name;
        $this->is_active = $user->is_active;
        $this->id_tipe_user = $user->id_tipe_user;
        $this->jabatan = $user->jabatan;
        $this->email = $user->email;
        $this->phone = $user->phone;
    }

    public function simpanDataUser(){
        $this->validate([
            'name' => 'required|string',
            'username' => 'required|string',
            'password' => 'nullable|string',
            'id_tipe_user' => 'required|numeric',
            'jabatan' => 'required|string',
            'email' => 'nullable|email',
            'phone' => 'nullable|numeric'
        ],[
            'name.required' => 'Nama tidak boleh kosong',
            'name.string' => 'Nama tidak valid !',
            'username.required' => 'Username tidak boleh kosong',
            'username.string' => 'Username tidak valid !',
            'password.string' => 'Password tidak valid !',
            'id_tipe_user.required' => 'Tipe User tidak boleh kosong',
            'id_tipe_user.numeric' => 'Tipe user tidak valid !',
            'jabatan.string' => 'Jabatan tidak valid !',
            'email.email' => 'Email tidak valid !',
            'phone.numeric' => 'Nomor HP tidak valid !',
            'phone.digits_between'
        ]);

        $this->username = Str::slug($this->username);
        $tipeUser = TipeUser::find($this->id_tipe_user);
        if(!$tipeUser){
            $message = 'Tipe user tidak ditemukan';
            return $this->emit('finishDataUser', 0, $message);
        }

        if($this->id_user == null){
            $user = User::where('username', $this->username)->first();
            if($user){
                $message = "Username sudah digunakan. silahkan gunakan username lainnya";
                return $this->emit('finishDataUser', 0, $message);
            }

            $user = User::where('email', $this->email)->first();
            if($user){
                $message = "Email sudah digunakan. silahkan gunakan email lainnya";
                return $this->emit('finishDataUser', 0, $message);
            }
        }else{
            $user = User::find($this->id_user);
            if($user && $user->username != $this->username){
                $checkUser = User::where('username', $this->username)->first();
                if($checkUser){
                    $message = "Username sudah digunakan oleh user lainnya. silahkan gunakan username lainnya";
                    return $this->emit('finishDataUser', 0, $message);
                }
            }

            if($user && $user->email != $this->email){
                $checkUser = User::where('email', $this->email)->first();
                if($checkUser){
                    $message = "Email sudah digunakan oleh user lainnya. silahkan gunakan email lainnya";
                    return $this->emit('finishDataUser', 0, $message);
                }
            }
        }

        $data['name'] = $this->name;
        $data['username'] = Str::slug($this->username);
        $data['jabatan'] = $this->jabatan;
        $data['phone'] = $this->phone;
        $data['email'] = $this->email;
        if($this->id_user == null && $this->password == null){
            $message = "Password harus diisi";
            return $this->emit('finishDataUser', 0, $message);
        }elseif($this->password){
            $data['password'] = Hash::make($this->password);
        }
        $data['is_active'] = $this->is_active ? 1 : 0;
        $data['id_tipe_user'] = $this->id_tipe_user;
        User::updateOrCreate([
            'id' => $this->id_user
        ], $data);

        $message = 'Berhasil manambahkan menyimpan data user';
        $this->emit('refreshUser');
        $this->resetInputFields();
        return $this->emit('finishSimpanData', 1, $message);
    }

    public function resetInputFields(){
        $this->id_user = null;
        $this->name = null;
        $this->username =null;
        $this->password = null;
        $this->is_active = null;
        $this->id_tipe_user = null;
        $this->jabatan = null;
        $this->phone = null;
        $this->email = null;
    }
}
