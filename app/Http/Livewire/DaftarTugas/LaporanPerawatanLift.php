<?php

namespace App\Http\Livewire\DaftarTugas;

use App\Models\Kondisi;
use App\Models\LaporanPekerjaan;
use App\Models\TemplatePekerjaan;
use Livewire\Component;

class LaporanPerawatanLift extends Component
{
    public $listeners = [];
    public $id_laporan_pekerjaan;
    public $laporanPekerjaan;
    public $listTemplatePekerjaan;
    public $listKondisi;
    public function render()
    {
        $this->listKondisi = Kondisi::get();
        $this->listTemplatePekerjaan = TemplatePekerjaan::where('id_form_master', $this->laporanPekerjaan->id_form_master)->get();
        $this->dispatchBrowserEvent('contentChange');
        return view('livewire.daftar-tugas.laporan-perawatan-lift');
    }

    public function mount($id_laporan_pekerjaan){
        $this->id_laporan_pekerjaan = $id_laporan_pekerjaan;
        $this->laporanPekerjaan = LaporanPekerjaan::find($this->id_laporan_pekerjaan);
    }
}
