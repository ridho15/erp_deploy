<?php

namespace App\Http\Controllers;

use App\CPU\Helpers;
use App\Mail\SendForgotPasswordToEmail;
use App\Models\LoginLogs;
use App\Models\User;
use App\Models\UserLog;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class AutentikasiController extends Controller
{
    public $crypt;

    public function __construct()
    {
        $this->crypt = new CryptController();
    }

    public function login()
    {
        return view('autentikasi.login');
    }

    public function postLogin(Request $request)
    {
        $data = $request->only('username', 'password');
        $validate = Validator::make($data, [
            'username' => 'required|string',
            'password' => 'required|string',
        ], [
            'username.required' => 'Username tidak boleh kosong',
            'username.string' => 'Username tidak valid !',
            'password.required' => 'Password tidak boleh kosong',
            'password.string' => 'Password tidak valid !',
        ]);

        if ($validate->fails()) {
            return redirect()->back()->with('fail', $validate->errors()->all()[0]);
        }

        $user = User::where('username', $data['username'])->first();
        if (!$user) {
            return redirect()->back()->with('fail', 'User dengan username '.$data['username'].' tidak ditemukan silahkan hubungi administrator');
        } else {
            if (!Hash::check($data['password'], $user->password)) {
                return redirect()->back()->with('fail', 'Password salah. silahkan ulangi !');
            }

            $token = $this->crypt->crypt(date('Y-m-d H:i:s'));
            $loginLogs = LoginLogs::create([
                'id_user' => $user->id,
                'devices' => $_SERVER['HTTP_USER_AGENT'],
                'token' => $token,
                'is_active' => 1,
            ]);

            $agent = Helpers::regexUserAgent($request->header('user-agent'));
            $version = $agent['browser'].' '.$agent['version'];

            $user_logs = UserLog::create([
                'id_user' => $user->id,
                'status' => 1,
                'user_agent' => $version ? $version : 'undetected',
                'lastLogin' => now(),
                'lastPasswordChange' => null,
                'last_ip' => $request->ip(),
            ]);

            $request->session()->put('id_user', $loginLogs->id_user);
            $request->session()->put('token', $loginLogs->token);
            $request->session()->put('id_tipe_user', $user->id_tipe_user);
            $request->session()->put('tipe_user_nama', $user->tipeUser->nama_tipe);
            $request->session()->put('user_log_id', $user_logs->id);

            if ($user->id_tipe_user == 4) {
                return redirect()->route('daftar-tugas');
            }elseif($user->id_tipe_user == 2){
                return redirect()->route('pre-order');
            }

            activity()->causedBy(HelperController::user())->log("Melakukan Login");
            return redirect()->route('dashboard')->with('success', 'Login Berhasil');
        }
    }

    public function logout()
    {
        $loginLogs = LoginLogs::where('id_user', session()->get('id_user'))
        ->where('token', session()->get('token'))
        ->first();
        if ($loginLogs) {
            $loginLogs->update([
                'is_active' => 0,
            ]);
        }
        activity()->causedBy(HelperController::user())->log("Logout account");

        session()->forget('id_user');
        session()->forget('token');

        return redirect()->route('login')->with('success', 'Logout Berhasil');
    }

    public function forgotPassword(){
        return view('autentikasi.forgot-password');
    }

    public function postForgotPassword(Request $request){
        $data = $request->only('email');
        $validate = Validator::make($data, [
            'email' => 'required|email'
        ], [
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Email tidak valid !'
        ]);

        if($validate->fails()){
            return redirect()->back()->with('fail', $validate->errors()->all()['0']);
        }

        $user = User::where('email', $data['email'])->first();
        if(!$user){
            $message = "Email pada user tidak ditemukan. Silahkan masukkan email lainnya atau hubungi administrator";
            return redirect()->back()->with('fail', $message);
        }

        // $crypt = new CryptController;
        // $carbon = Carbon::now()->addMinutes(30);
        // $data['user'] = $user;
        // $dataToken = json_encode([
        //     'id' => $user->id,
        //     'email' => $user->emai,
        //     'expired_at' => $carbon->format('Y-m-d H:i:s')
        // ]);
        // $token = $crypt->crypt($dataToken);
        // $data['token'] = $token;
        // $data['url'] = url('/reset-ulang-password/' . $token);

        Mail::to($user->email)->send(new SendForgotPasswordToEmail($user));
        $message = "Berhasil mengirim alamat untuk mereset ulang password. Silahkan check email anda";

        return redirect()->back()->with('success', $message);
    }

    public function resetUlangPassword($token){
        $crypt = new CryptController;
        $dataToken = $crypt->crypt($token, 'd');
        $dataToken = json_decode($dataToken);
        if(strtotime($dataToken->expired_at) < strtotime(now())){
            return view('helper.expired-page');
        }

        $data['token'] = $token;
        return view('autentikasi.reset-password', $data);
    }

    public function postResetUlangPassword(Request $request){
        $crypt = new CryptController;
        $data = $request->only('password', 'password_konfirmasi', 'token');
        $validate = Validator::make($data, [
            'password' => 'required|string',
            'password_konfirmasi' => 'required|string|same:password',
            'token' => 'required|string'
        ]);

        if($validate->fails()){
            return redirect()->back()->with('fail', $validate->errors()->all()[0]);
        }

        $dataToken = $crypt->crypt($data['token'], 'd');
        $dataToken = json_decode($dataToken);

        if(strtotime($dataToken->expired_at) < strtotime(now())){
            return view('helper.expired-page');
        }

        $user = User::find($dataToken->id);
        if(!$user){
            return response()->json([
                'status' => false,
                'message' => 'Data user tidak ditemukan',
                'data' => null
            ]);
        }

        $user->update([
            'password' => Hash::make($data['password'])
        ]);

        return redirect()->route('login')->with('success', 'Berhasil mengupdate password. Silahkan login kembali');
    }
}
