<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\LaporanPekerjaan;
use Illuminate\Http\Request;

class DaftarTugasController extends Controller
{
    public function index(){
        $data['title'] = "Daftar Tugas";
        $data['active'] = ['daftar-tugas'];
        $data['breadCrumb'] = ['Daftar Tugas', 'Data'];

        return view('daftar-tugas.index', $data);
    }

    public function kelola($id){
        $laporanPekerjaan = LaporanPekerjaan::find($id);
        if(!$laporanPekerjaan){
            return redirect()->back()->with('fail', "Data tidak ditemukan !");
        }

        $data['title'] = "Kelola Tugas";
        $data['active'] = ['daftar-tugas'];
        $data['breadCrumb'] = ['Daftar Tugas', 'Kelola'];
        $data['laporanPekerjaan'] = $laporanPekerjaan;

        return view('daftar-tugas.kelola', $data);
    }

    public function ambil($id){
        $laporanPekerjaan = LaporanPekerjaan::find($id);
        if(!$laporanPekerjaan){
            $message = "Data tugas tidak ditemukan !";
            return redirect()->back()->with('fail', $message);
        }

        $listIdUser = json_decode($laporanPekerjaan->id_user);
        if($listIdUser == null){
            $listIdUser = [];
        }
        if(is_array($listIdUser) && !in_array(session()->get('id_user'), $listIdUser)){
            array_push($listIdUser, session()->get('id_user'));
        }

        $laporanPekerjaan->update([
            'id_user' => json_encode($listIdUser)
        ]);

        $message = "Berhasil mengambil tugas";
        return redirect()->back()->with('success', $message);
    }

    public function mulai($id){
        $laporanPekerjaan = LaporanPekerjaan::find($id);
        if(!$laporanPekerjaan){
            $message = "Laporan pekerjaan tidak ditemukan !";
            return redirect()->back()->with('fail', $message);
        }

        $laporanPekerjaan->update([
            'jam_mulai' => now()
        ]);

        $message = "Berhasil";
        return redirect()->back()->with('success', $message);
    }
}
