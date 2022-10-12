<?php

namespace App\Http\Livewire\DaftarTugas;

use App\Models\LaporanPekerjaanBarang;
use Livewire\Component;

class LaporanSparepart extends Component
{
    public $listeners = ['hapusLaporanPekerjaanBarang', 'setDataLaporanPekerjaanBarang'];
    public $listLaporanPekerjaanBarang = [];
    public $id_laporan_pekerjaan_barang;
    public $id_laporan_pekerjaan;
    public $id_barang;
    public $catatan_teknisi;
    public $keterangan_customer;
    public $qty;
    public $cari;
    public function render()
    {
        $this->listLaporanPekerjaanBarang = LaporanPekerjaanBarang::where(function($query){
            $query->whereHas('barang', function($query){
                $query->where('nama', 'LIKE', '%' . $this->cari . '%');
            });
        })->where('id_laporan_pekerjaan', $this->id_laporan_pekerjaan)->get();
        return view('livewire.daftar-tugas.laporan-sparepart');
    }

    public function mount($id_laporan_pekerjaan){
        $this->id_laporan_pekerjaan = $id_laporan_pekerjaan;
    }

    public function setDataLaporanPekerjaanBarang($id){
        $laporanPekerjaanBarang = LaporanPekerjaanBarang::find($id);
        if(!$laporanPekerjaanBarang){
            $message = "Data laporan barang tidak ditemukan !";
            return session()->flash('fail', $message);
        }

        $this->id_laporan_pekerjaan = $laporanPekerjaanBarang->id;
        $this->id_barang = $laporanPekerjaanBarang->id_barang;
        $this->id_laporan_pekerjaan = $laporanPekerjaanBarang->id_laporan_pekerjaan;
        $this->catatan_teknisi = $laporanPekerjaanBarang->catatan_teknisi;
        $this->keterangan_customer = $laporanPekerjaanBarang->keterangan_customer;
        $this->qty = $laporanPekerjaanBarang->qty;
    }

    public function hapusLaporanPekerjaanBarang($id){
        $laporanPekerjaanBarang = LaporanPekerjaanBarang::find($id);
        if(!$laporanPekerjaanBarang){
            $message = "Data laporan barang tidak ditemukan !";
            return session()->flash('fail', $message);
        }

        $laporanPekerjaanBarang->delete();
        $message = "Data laporan barang berhasil dihapus";

        $this->emit('finishSimpanData', 1, $message);
        return session()->flash('success', $message);
    }
}
