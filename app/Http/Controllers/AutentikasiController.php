<?php

namespace App\Http\Controllers;

use App\CPU\Helpers;
use App\Mail\SendForgotPasswordToEmail;
use App\Models\Barang;
use App\Models\LoginLogs;
use App\Models\Notifikasi;
use App\Models\PreOrder;
use App\Models\SupplierOrder;
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
            $request->session()->put('list_tipe_user', $user->list_tipe_user);
            $request->session()->put('user_log_id', $user_logs->id);

            if ($user->id_tipe_user == 4) {
                return redirect()->route('daftar-tugas');
            }elseif($user->id_tipe_user == 2){
                return redirect()->route('pre-order');
            }

            $this->buatNotifikasi();
            HelperController::createAgenda();

            activity()->causedBy(HelperController::user())->log("Melakukan Login");
            return redirect()->route('dashboard')->with('success', 'Login Berhasil');
        }
    }

    public function buatNotifikasi(){
        $listBarang = Barang::get();
        $totalBarangMinimum = 0;
        foreach ($listBarang as $item) {
            if($item->stock <= $item->min_stock){
                $totalBarangMinimum++;
            }
        }

        $message = "Ada barang dengan stock dibawah minimum dengan banyak barang " . $totalBarangMinimum . ' .Silahkan Check Stock Barang';
        $notifikasiStockMinimum = Notifikasi::whereDate('tanggal', now())
        ->where('tipe_notifikasi', 1)
        ->where('id_user', session()->get('id_user'))
        ->first();

        if ($totalBarangMinimum > 0) {
            if($notifikasiStockMinimum){
                $notifikasiStockMinimum->update([
                    'pesan' => $message,
                    'route' => 'laporan.spareparts',
                    'tanggal' => now(),
                    'status' => 0
                ]);
            }else{
                Notifikasi::create([
                    'tipe_notifikasi' => 1,
                    'id_user' => session()->get('id_user'),
                    'tanggal' => now(),
                    'pesan' => $message,
                    'route' => 'laporan.spareparts',
                ]);
            }
        }

        $tanggal_jatuh_tempo = Carbon::now()->addDays(3);
        $totalSupplierOrder = SupplierOrder::where('status_pembayaran', '!=', 2)
        ->where('status_order', 4)
        ->whereDate('tanggal_tempo_pembayaran', '<=', $tanggal_jatuh_tempo)
        ->count();

        $message = "Ada pembayaran orderan ke supplier yang belum di lakukan berjumlah " . $totalSupplierOrder . ' .Silahkan check pembayaran Supplier Order';

        $notifikasiSupplierOrder = Notifikasi::whereDate('tanggal', now())
        ->where('tipe_notifikasi', 2)
        ->where('id_user', session()->get('id_user'))
        ->first();

        if ($totalSupplierOrder > 0) {
            if($notifikasiSupplierOrder){
                $notifikasiSupplierOrder->update([
                    'pesan' => $message,
                    'route' => 'laporan.account-payable',
                    'tanggal' => now(),
                    'status' => 0,
                ]);
            }else{
                Notifikasi::create([
                    'tipe_notifikasi' => 2,
                    'id_user' => session()->get('id_user'),
                    'tanggal' => now(),
                    'pesan' => $message,
                    'route' => 'laporan.account-payable',
                ]);
            }

        }
        $tanggal_jatuh_tempo = Carbon::now()->addDays(3);
        $totalPreOrder = PreOrder::whereHas('quotation', function($query){
            $query->whereHas('laporanPekerjaan', function($query){
                $query->where('signature', '!=', null)
                ->where('jam_selesai', '!=', null);
            });
        })->whereDate('tanggal_tempo_pembayaran', '<=', $tanggal_jatuh_tempo)
        ->count();

        $message = "Ada pembayaran orderan dari customer yang belum di lakukan berjumlah " . $totalPreOrder . ' .Silahkan check pembayaran Pre order';

        $notifikasiPreOrder = Notifikasi::whereDate('tanggal', now())
        ->where('tipe_notifikasi', 3)
        ->where('id_user', session()->get('id_user'))
        ->first();

        if ($totalPreOrder > 0) {
            if($notifikasiPreOrder){
                $notifikasiPreOrder->update([
                    'pesan' => $message,
                    'route' => 'laporan.account-receivable',
                    'tanggal' => now(),
                    'status' => 0
                ]);
            }else{
                Notifikasi::create([
                    'tipe_notifikasi' => 3,
                    'id_user' => session()->get('id_user'),
                    'tanggal' => now(),
                    'pesan' => $message,
                    'route' => 'laporan.account-receivable',
                ]);
            }
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
