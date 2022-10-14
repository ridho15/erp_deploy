<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Barryvdh\DomPDF\Facade\Pdf;

class DashboardController extends Controller
{
    public function index()
    {
        $data['title'] = 'Dashboard Admin | ERP';
        $data['active'] = ['dashboard'];
        $data['breadCrumb'] = ['Dashbord', 'Data'];

        return view('dashboard.index', $data);
    }

    public function testing(){
        $data['title'] = 'Dashboard Admin | ERP';
        $data['active'] = ['dashboard'];
        $data['breadCrumb'] = ['Dashbord', 'Data'];
        $kategori = Kategori::get();
        $data['listKategori'] = $kategori;
        return redirect()->route('testing.export-pdf');
        return view('pdf_view.kategori', $data);
    }

    public function exportPdf(){
        $data['title'] = 'Coba Export';
        $data['active'] = ['dashboard'];
        $data['breadCrumb'] = ['Dashbord', 'Data'];
        $data['listKategori'] = Kategori::get();
        view()->share('listKategori', $data);
        $pdf = Pdf::loadView('pdf_view.kategori', $data);
        return $pdf->download('pdf_file.pdf');
    }
}
