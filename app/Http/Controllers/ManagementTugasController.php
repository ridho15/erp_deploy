<?php

namespace App\Http\Controllers;

use App\CPU\Helpers;
use App\Models\CatatanTeknisiPekerjaan;
use App\Models\LaporanPekerjaan;
use App\Models\WebConfig;
use Barryvdh\DomPDF\Facade\Pdf;

class ManagementTugasController extends Controller
{
    public function index()
    {
        $data['title'] = 'Management Tugas';
        $data['active'] = ['management-tugas'];
        $data['breadCrumb'] = ['Management Tugas', 'Data'];

        return view('management-tugas.index', $data);
    }

    public function detail($id)
    {
        $laporanPekerjaan = LaporanPekerjaan::find($id);
        if (!$laporanPekerjaan) {
            return redirect()->back()->with('fail', 'Data management tugas tidak ditemukan');
        }

        $data['title'] = 'Detail Management Tugas';
        $data['active'] = ['management-tugas'];
        $data['breadCrumb'] = ['Management Tugas', 'Detail'];
        $data['laporanPekerjaan'] = $laporanPekerjaan;

        return view('management-tugas.detail', $data);
    }

    public function export($id)
    {
        $data['title'] = 'Laporan Pekerjaan';
        $laporanPekerjaan = LaporanPekerjaan::find($id);
        if (!$laporanPekerjaan) {
            return redirect()->back()->with('fail', 'Data Laporan Pekerjaan tidak ditemukan !');
        }
        $listTemplatePekerjaan = $laporanPekerjaan->formMaster->templatePekerjaan;
        $data['laporanPekerjaan'] = $laporanPekerjaan;
        $data['listTemplatePekerjaan'] = $listTemplatePekerjaan;
        $data['web_logo'] = WebConfig::where('type', 'logo')->first();
        $data['web_name'] = WebConfig::where('type', 'web_name')->first();
        $data['listCatatanTeknisiPekerjaan'] = CatatanTeknisiPekerjaan::where('id_laporan_pekerjaan', $id)->get();
        $pdf = Pdf::loadView('pdf_view.laporan_pekerjaan', $data);

        return $pdf->download('laporan_pekerjaan_'.strtotime(now()).'.pdf');

        return view('pdf_view.laporan_pekerjaan', $data);
    }
}
