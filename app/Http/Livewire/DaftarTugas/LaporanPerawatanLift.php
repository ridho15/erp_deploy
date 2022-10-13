<?php

namespace App\Http\Livewire\DaftarTugas;

use App\Models\Kondisi;
use App\Models\LaporanPekerjaan;
use App\Models\LaporanPekerjaanChecklist;
use App\Models\TemplatePekerjaan;
use Livewire\Component;

class LaporanPerawatanLift extends Component
{
    public $listeners = [
        'setLaporanPekerjaanChecklist',
        'simpanLaporanPekerjaanChecklist',
    ];
    public $id_kondisi;
    public $id_laporan_pekerjaan;
    public $laporanPekerjaan;
    public $listTemplatePekerjaan;
    public $listKondisi;
    public $listKondisiLift = [];
    public $listIdKondisiLift = [];
    public $listIdTemplatePekerjaanDetail = [];
    public $listLaporanPekerjaanChecklist = [];
    public function render()
    {
        $this->listKondisi = Kondisi::get();
        $this->listTemplatePekerjaan = TemplatePekerjaan::where('id_form_master', $this->laporanPekerjaan->id_form_master)->get();
        $this->dispatchBrowserEvent('contentChange');
        $this->listLaporanPekerjaanChecklist = LaporanPekerjaanChecklist::where('id_laporan_pekerjaan', $this->id_laporan_pekerjaan)->get();
        return view('livewire.daftar-tugas.laporan-perawatan-lift');
    }

    public function mount($id_laporan_pekerjaan){
        $this->id_laporan_pekerjaan = $id_laporan_pekerjaan;
        $this->laporanPekerjaan = LaporanPekerjaan::find($this->id_laporan_pekerjaan);
    }

    public function setLaporanPekerjaanChecklist($id_kondisi, $id_template_pekerjaan_detail){
        array_push($this->listIdKondisiLift, $id_kondisi);
        array_push($this->listIdTemplatePekerjaanDetail, $id_template_pekerjaan_detail);
        array_push($this->listKondisiLift, collect([
            'id_kondisi' => $id_kondisi,
            'id_template_pekerjaan_detail' => $id_template_pekerjaan_detail
        ]));
    }

    public function simpanLaporanPekerjaanChecklist(){
        foreach ($this->listKondisiLift as $value) {
            LaporanPekerjaanChecklist::updateOrCreate([
                'id_laporan_pekerjaan' => $this->id_laporan_pekerjaan,
                'id_template_pekerjaan_detail' => $value['id_template_pekerjaan_detail'],
            ], [
                'id_laporan_pekerjaan' => $this->id_laporan_pekerjaan,
                'id_template_pekerjaan_detail' => $value['id_template_pekerjaan_detail'],
                'id_kondisi' => $value['id_kondisi'],
                'keterangan' => null
            ]);
        }

        $message = "Berhasil menyimpan data";
        $this->resetInputFields();
        $this->emit('finishSimpanData', 1, $message);
        return session()->flash('success', $message);
    }

    public function resetInputFields(){
        $this->listKondisiLift = [];
        $this->listIdKondisiLift = [];
        $this->listIdTemplatePekerjaanDetail = [];
    }
}
