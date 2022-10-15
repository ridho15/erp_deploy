<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\LaporanPekerjaan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ManagementTugasController extends Controller
{
    public function index(){
        $data['title'] = "Management Tugas";
        $data['active'] = ['management-tugas'];
        $data['breadCrumb'] = ['Management Tugas', 'Data'];

        return view('management-tugas.index', $data);
    }

    public function detail($id){
        $laporanPekerjaan = LaporanPekerjaan::find($id);
        if(!$laporanPekerjaan){
            return redirect()->back()->with('fail', "Data management tugas tidak ditemukan");
        }

        $data['title'] = "Detail Management Tugas";
        $data['active'] = ['management-tugas'];
        $data['breadCrumb'] = ['Management Tugas', 'Detail'];
        $data['laporanPekerjaan'] = $laporanPekerjaan;

        return view('management-tugas.detail', $data);
    }

    public function export($id){
        $data['title'] = "Laporan Pekerjaan";
        $laporanPekerjaan = LaporanPekerjaan::find($id);
        if(!$laporanPekerjaan){
            return redirect()->back()->with('fail', "Data Laporan Pekerjaan tidak ditemukan !");
        }
        $listTemplatePekerjaan = $laporanPekerjaan->formMaster->templatePekerjaan;
        $data['laporanPekerjaan'] = $laporanPekerjaan;
        $data['listTemplatePekerjaan'] = $listTemplatePekerjaan;
        $pdf = Pdf::loadView('pdf_view.laporan_pekerjaan', $data);
        return $pdf->download('laporan_pekerjaan_'. strtotime(now()) .'.pdf');
        return view('pdf_view.laporan_pekerjaan', $data);
    }
}
