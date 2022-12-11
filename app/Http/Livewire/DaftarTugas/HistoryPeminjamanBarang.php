<?php

namespace App\Http\Livewire\DaftarTugas;

use App\Models\LaporanPekerjaanBarangLog;
use Livewire\Component;
use Livewire\WithPagination;

class HistoryPeminjamanBarang extends Component
{
    use WithPagination;
    public $paginationTheme = 'bootstrap';
    public $total_show = 10;
    public $cari;
    public $id_laporan_pekerjaan;

    protected $listHistoryPeminjamanBarang;
    public function render()
    {
        $this->listHistoryPeminjamanBarang = LaporanPekerjaanBarangLog::whereHas('laporanPekerjaanBarang', function($query){
            $query->whereHas('laporanPekerjaan', function($query){
                $query->where('id_laporan_pekerjaan', $this->id_laporan_pekerjaan);
            })->where(function($query){
                $query->whereHas('barang', function($query){
                    $query->where('id', 'LIKE', '%' . $this->cari . '%')
                    ->orWhere('nama', 'LIKE', '%' . $this->cari . '%')
                    ->orWhereHas('satuan', function($query){
                        $query->where('nama_satuan', 'LIKE', '%' . $this->cari . '%');
                    });
                });
            });
        })->orderBy('updated_at', 'DESC')->paginate($this->total_show);

        $data['listHistoryPeminjamanBarang'] = $this->listHistoryPeminjamanBarang;
        return view('livewire.daftar-tugas.history-peminjaman-barang', $data);
    }

    public function mount($id_laporan_pekerjaan){
        $this->id_laporan_pekerjaan = $id_laporan_pekerjaan;
    }
}
