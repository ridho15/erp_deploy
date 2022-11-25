<?php

namespace App\Http\Livewire\PinjamMeminjam;

use App\Models\LaporanPekerjaanBarang;
use Livewire\Component;
use Livewire\WithPagination;

class AcureateKeluar extends Component
{
    use WithPagination;
    public $listeners = [
        'refreshAcurateKeluar' => '$refresh',
        'simpanCheck'
    ];
    public $paginationTheme = 'bootstrap';
    public $total_show = 10;
    public $cari;

    protected $listAcurateKeluar;
    public function render()
    {
        $this->listAcurateKeluar = LaporanPekerjaanBarang::where(function($query){
            $query->where('catatan_teknisi', 'LIKE', '%' . $this->cari . '%')
            ->orWhere('keterangan_customer', 'LIKE', '%' . $this->cari . '%')
            ->orWhere('qty', 'LIKE', '%' . $this->cari . '%')
            ->orWhereHas('barang', function($query){
                $query->where('nama', 'LIKE', '%' . $this->cari . '%');
            });
        })->where('status', 3)->where('konfirmasi', 0)->orderBy('updated_at', 'DESC')
        ->paginate($this->total_show);

        $data['listAcurateKeluar'] = $this->listAcurateKeluar;
        return view('livewire.pinjam-meminjam.acureate-keluar', $data);
    }

    public function simpanCheck($id){
        $laporanPekerjaanBarang = LaporanPekerjaanBarang::find($id);
        if(!$laporanPekerjaanBarang){
            $message = "Data laporan pekerjaan barang tidak ditemukan";
            return session()->flash('fail', $message);
        }

        $laporanPekerjaanBarang->update([
            'status' => 3,
            'konfirmasi' => 1,
            'meminjamkan' => session()->get('id_user')
        ]);

        $message = "Berhasil mengkonfirmasi data";
        $this->emit('refreshBarangDibalikan');
        return session()->flash('success', $message);
    }
}
