<?php

namespace App\Http\Livewire\DaftarTugas;

use App\Models\LaporanPekerjaan;
use Livewire\Component;

class Detail extends Component
{
    public $listeners = [
        'refreshLaporanPekerjaan' => '$refresh',
        'confirmasiBarang'
    ];
    public $id_laporan_pekerjaan;
    public $laporanPekerjaan;
    public function render()
    {
        $this->laporanPekerjaan = LaporanPekerjaan::find($this->id_laporan_pekerjaan);
        return view('livewire.daftar-tugas.detail');
    }

    public function mount($id_laporan_pekerjaan){
        $this->id_laporan_pekerjaan = $id_laporan_pekerjaan;
    }

    public function confirmasiBarang(){
        $laporanPekerjaan = LaporanPekerjaan::find($this->id_laporan_pekerjaan);
        if(!$laporanPekerjaan){
            $message = 'Data laporan pekerjaan tidak ditemukan';
            return session()->flash('fail', $message);
        }

        $laporanPekerjaan->update([
            'confirmasi_customer_barang' => 1
        ]);

        $message = "Barang sudah di check dan di konfirmasi";
        $this->emit('refreshLaporanPekerjaan');
        return session()->flash('success', $message);
    }
}
