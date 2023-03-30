<?php

namespace App\Http\Livewire\PinjamMeminjam;

use App\Http\Controllers\HelperController;
use App\Models\BarangStockLog;
use App\Models\LaporanPekerjaanBarang;
use Livewire\Component;
use Livewire\WithPagination;

class BarangDibalikan extends Component
{
    use WithPagination;
    public $listeners = [
        'simpanCheck',
        'refreshBarangDibalikan' => '$refresh'
    ];
    public $paginationTheme = 'bootstrap';
    public $total_show = 10;
    public $cari;
    protected $listBarangDibalikan;
    public function render()
    {
        // $this->listBarangDibalikan = BarangStockLog::where(function($query){
        //     $query->where('perubahan', 'LIKE', '%' . $this->cari . '%')
        //     ->orWhere('tanggal_perubahan', 'LIKE', '%' . $this->cari . '%')
        //     ->orWhere('id_barang', 'LIKE', '%' . $this->cari . '%')
        //     ->orWhereHas('barang', function($query){
        //         $query->where('nama', 'LIKE', '%' . $this->cari . '%')
        //         ->orWhere('deskripsi', 'LIKE', '%' . $this->cari . '%');
        //     });
        // })->where('id_tipe_perubahan_stock', 5)->orderBy('tanggal_perubahan', 'DESC')->paginate($this->total_show);
        $this->listBarangDibalikan = LaporanPekerjaanBarang::where(function ($query) {
            $query->where('catatan_teknisi', 'LIKE', '%' . $this->cari . '%')
                ->orWhere('keterangan_customer', 'LIKE', '%' . $this->cari . '%')
                ->orWhere('qty', 'LIKE', '%' . $this->cari . '%')
                ->orWHere('id_laporan_pekerjaan', 'LIKE', '%' . $this->cari . '%')
                ->orWhereHas('barang', function ($query) {
                    $query->where('nama', 'LIKE', '%' . $this->cari . '%')
                        ->orWhere('nomor', 'LIKE', '%' . $this->cari . '%');
                });
        })->where('status', 3)->orderBy('updated_at', 'DESC')
            ->paginate($this->total_show);
        $data['listBarangDibalikan'] = $this->listBarangDibalikan;
        return view('livewire.pinjam-meminjam.barang-dibalikan', $data);
    }

    public function mount()
    {
    }

    public function simpanCheck($id)
    {
        $barangStockLog = BarangStockLog::find($id);
        if (!$barangStockLog) {
            $message = "Data tidak ditemukan";
            return session()->flash('fail', $message);
        }

        $barangStockLog->update([
            'check' => $barangStockLog->check == 1 ? 0 : 1
        ]);

        activity()->causedBy(HelperController::user())->log("Check barang di kembalikan");
    }
}
