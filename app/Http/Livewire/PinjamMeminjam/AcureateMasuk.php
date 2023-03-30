<?php

namespace App\Http\Livewire\PinjamMeminjam;

use App\Http\Controllers\HelperController;
use App\Models\Barang;
use App\Models\LaporanPekerjaanBarang;
use App\Models\LaporanPekerjaanBarangLog;
use App\Models\Rak;
use App\Models\RakLog;
use Livewire\Component;
use Livewire\WithPagination;

class AcureateMasuk extends Component
{
    use WithPagination;
    public $listeners = [
        'refreshAcurateKeluar' => '$refresh',
        'simpanCheck'
    ];
    public $paginationTheme = 'bootstrap';
    public $total_show = 10;
    public $cari;

    protected $listAcurateMasuk;
    public function render()
    {
        $this->listAcurateMasuk = LaporanPekerjaanBarang::whereHas('barang')
            ->where(function ($query) {
                $query->where('catatan_teknisi', 'LIKE', '%' . $this->cari . '%')
                    ->orWhere('keterangan_customer', 'LIKE', '%' . $this->cari . '%')
                    ->orWhere('qty', 'LIKE', '%' . $this->cari . '%')
                    ->orWhereHas('barang', function ($query) {
                        $query->where('nama', 'LIKE', '%' . $this->cari . '%')
                            ->orWhere('nomor', 'LIKE', '%' . $this->cari . '%');
                    });
            })->where('status', 3)->where('konfirmasi', 0)->orderBy('updated_at', 'DESC')
            ->paginate($this->total_show);

        $data['listAcurateMasuk'] = $this->listAcurateMasuk;
        return view('livewire.pinjam-meminjam.acureate-masuk', $data);
    }

    public function simpanCheck($id)
    {
        $laporanPekerjaanBarang = LaporanPekerjaanBarang::find($id);
        if (!$laporanPekerjaanBarang) {
            $message = "Data laporan pekerjaan barang tidak ditemukan";
            return session()->flash('fail', $message);
        }

        $laporanPekerjaanBarang->update([
            'status' => 3,
            'konfirmasi' => 1,
            'meminjamkan' => session()->get('id_user')
        ]);

        LaporanPekerjaanBarangLog::create([
            'id_laporan_pekerjaan_barang' => $laporanPekerjaanBarang->id,
            'status' => 3
        ]);

        $message = "Berhasil mengkonfirmasi data";
        activity()->causedBy(HelperController::user())->log("Acc Accurate masuk");
        $this->emit('refreshBarangDibalikan');
        return session()->flash('success', $message);
    }
}
