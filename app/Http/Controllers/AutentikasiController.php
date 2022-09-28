<?php

namespace App\Http\Controllers;

use App\Models\LoginLogs;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AutentikasiController extends Controller
{
    public $crypt;
    function __construct()
    {
        $this->crypt = new CryptController;
    }
    public function login(){
        return view('autentikasi.login');
    }

    public function postLogin(Request $request){
        $data = $request->only('username', 'password');
        $validate = Validator::make($data, [
            'username' => 'required|string',
            'password' => 'required|string'
        ], [
            'username.required' => 'Username tidak boleh kosong',
            'username.string' => 'Username tidak valid !',
            'password.required' => 'Password tidak boleh kosong',
            'password.string' => 'Password tidak valid !'
        ]);

        if($validate->fails()){
            return redirect()->back()->with('fail', $validate->errors()->all()[0]);
        }

        $user = User::where('username', $data['username'])->first();
        if(!$user){
            return redirect()->back()->with('fail', 'User dengan username ' . $data['username'] . ' tidak ditemukan silahkan hubungi administrator');
        }else{
            if(!Hash::check($data['password'], $user->password)){
                return redirect()->back()->with('fail', 'Password salah. silahkan ulangi !');
            }

            $token = $this->crypt->crypt(date('Y-m-d H:i:s'));
            $loginLogs = LoginLogs::create([
                'id_user' => $user->id,
                'device' => $_SERVER['HTTP_USER_AGENT'],
                'token' => $token,
                'is_active' => 1
            ]);

            $request->session()->put('id_user', $loginLogs->id_user);
            $request->session()->put('token', $loginLogs->token);

            return redirect()->route('dashboard')->with('success', 'Login Berhasil');
        }
    }
}
