<?php

namespace App\Http\Livewire\PinjamMeminjam;

use App\Models\LaporanPekerjaanBarang;
use Livewire\Component;
use Livewire\WithPagination;

class BarangDikasih extends Component
{
    use WithPagination;
    public $paginationTheme = 'bootstrap';
    public $listeners = [
        'refreshBarangDikasih' => '$refresh'
    ];
    public $total_show = 10;
    public $cari;

    protected $listBarangDikasih;
    public function render()
    {
        $this->listBarangDikasih = LaporanPekerjaanBarang::where(function ($query) {
            $query->where('catatan_teknisi', 'LIKE', '%' . $this->cari . '%')
                ->orWhere('keterangan_customer', 'LIKE', '%' . $this->cari . '%')
                ->orWhere('qty', 'LIKE', '%' . $this->cari . '%')
                ->orWHere('id_laporan_pekerjaan', 'LIKE', '%' . $this->cari . '%')
                ->orWhereHas('barang', function ($query) {
                    $query->where('nama', 'LIKE', '%' . $this->cari . '%')
                        ->orWhere('nomor', 'LIKE', '%' . $this->cari . '%');
                });
        })->where('status', 2)->where('konfirmasi', 0)->orderBy('updated_at', 'DESC')
            ->paginate($this->total_show);

        $data['listBarangDikasih'] = $this->listBarangDikasih;
        return view('livewire.pinjam-meminjam.barang-dikasih', $data);
    }

    public function mount()
    {
    }
}
