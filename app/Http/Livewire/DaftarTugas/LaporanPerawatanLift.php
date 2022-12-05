<?php

namespace App\Http\Livewire\DaftarTugas;

use App\Http\Controllers\HelperController;
use App\Models\Kondisi;
use App\Models\LaporanPekerjaan;
use App\Models\LaporanPekerjaanChecklist;
use App\Models\Pekerjaan;
use App\Models\PerawatanLiftKondisi;
use App\Models\TemplatePekerjaan;
use App\Models\TemplatePekerjaanDetail;
use Livewire\Component;

class LaporanPerawatanLift extends Component
{
    public $listeners = [
        'setLaporanPekerjaanChecklist',
        'simpanLaporanPekerjaanChecklist',
        'setKondisi',
        'setPekerjaan',
        'setStatus',
        'simpanKeterangan',
        'changeStatus'
    ];
    public $cari;
    public $id_kondisi;
    public $id_laporan_pekerjaan;
    public $id_template_pekerjaan_detail;
    public $laporanPekerjaan;
    public $listTemplatePekerjaan;
    public $listKondisi;
    public $periode;
    public $pekerjaan = [];
    public $statusPekerjaan;
    public $templateListId;

    public $keterangan;

    public $listKondisiLift = [];
    public $listIdKondisiLift = [];
    public $listIdTemplatePekerjaanDetail = [];
    public $listLaporanPekerjaanChecklist = [];

    public function render()
    {
        $this->listKondisi = Kondisi::get();
        $this->listPekerjaan = Pekerjaan::get();
        // $this->listTemplatePekerjaan = TemplatePekerjaan::where(function($query){
        //     $query->where('nama_pekerjaan', 'LIKE', '%' . $this->cari . '%')
        //     ->orWhereHas('parent', function($query){
        //         $query->where('nama_pekerjaan', 'LIKE', '%' . $this->cari . '%');
        //     })->orWhereHas('children', function($query){
        //         $query->where('nama_pekerjaan', 'LIKE', '%' . $this->cari . '%');
        //     });
        // })
        // ->whereHas('children', function($query){
        //     $query->where('periode', 'LIKE', '%' . $this->periode . '%');
        // })
        // ->where('id_form_master', $this->laporanPekerjaan->id_form_master)->get();

        $this->listTemplatePekerjaan = TemplatePekerjaan::where('id_parent', null)->where('id_form_master', $this->laporanPekerjaan->id_form_master)->get();
        $this->listLaporanPekerjaanChecklist = LaporanPekerjaanChecklist::where('id_laporan_pekerjaan', $this->id_laporan_pekerjaan)->get();
        $this->periode = $this->laporanPekerjaan->periode;

        $this->dispatchBrowserEvent('contentChange');
        return view('livewire.daftar-tugas.laporan-perawatan-lift');
    }

    public function mount($id_laporan_pekerjaan)
    {
        $this->id_laporan_pekerjaan = $id_laporan_pekerjaan;
        $this->laporanPekerjaan = LaporanPekerjaan::find($this->id_laporan_pekerjaan);
        $this->periode = $this->laporanPekerjaan->periode;
    }

    public function setLaporanPekerjaanChecklist($id_kondisi, $id_template_pekerjaan_detail)
    {
        array_push($this->listIdKondisiLift, $id_kondisi);
        array_push($this->listIdTemplatePekerjaanDetail, $id_template_pekerjaan_detail);
        array_push($this->listKondisiLift, collect([
            'id_kondisi' => $id_kondisi,
            'id_template_pekerjaan_detail' => $id_template_pekerjaan_detail,
        ]));
    }

    public function simpanLaporanPekerjaanChecklist()
    {
        foreach ($this->listKondisiLift as $value) {
            LaporanPekerjaanChecklist::updateOrCreate([
                'id_laporan_pekerjaan' => $this->id_laporan_pekerjaan,
                'id_template_pekerjaan_detail' => $value['id_template_pekerjaan_detail'],
            ], [
                'id_laporan_pekerjaan' => $this->id_laporan_pekerjaan,
                'id_template_pekerjaan_detail' => $value['id_template_pekerjaan_detail'],
                'id_kondisi' => $value['id_kondisi'],
                'keterangan' => null,
            ]);
        }

        $message = 'Berhasil menyimpan data';
        activity()->causedBy(HelperController::user())->log("Menyimpan data laporan perawatan lift");
        $this->resetInputFields();
        $this->emit('finishSimpanData', 1, $message);

        return session()->flash('success', $message);
    }

    public function setPekerjaan($pekerjaan, $id_template_pekerjaan_detail)
    {
        LaporanPekerjaanChecklist::updateOrCreate([
            'id_laporan_pekerjaan' => $this->id_laporan_pekerjaan,
            'id_template_pekerjaan_detail' => $id_template_pekerjaan_detail
        ], [
            'id_laporan_pekerjaan' => $this->id_laporan_pekerjaan,
            'id_template_pekerjaan_detail' => $id_template_pekerjaan_detail,
            'pekerjaan' => json_encode($pekerjaan)
        ]);

        $message = 'Berhasil menyimpan data';
        activity()->causedBy(HelperController::user())->log("Memilih pekerjaan untuk perawatan lift");
        return session()->flash('success', $message);
    }

    public function setStatus()
    {
        $detailList = TemplatePekerjaanDetail::find($this->templateListId);
        $detailList->status = $this->statusPekerjaan;
        $detailList->save();

        $message = 'Berhasil merubah status pekerjaan';
        activity()->causedBy(HelperController::user())->log("Update status pekerjaan");
        $this->emit('finishSimpanData', 1, $message);

        // return session()->flash('success', $message);
    }

    public function resetInputFields()
    {
        $this->listKondisiLift = [];
        $this->listIdKondisiLift = [];
        $this->listIdTemplatePekerjaanDetail = [];
    }

    public function simpanKeterangan($keterangan, $id_laporan_pekerjaan_detail){
        LaporanPekerjaanChecklist::updateOrCreate([
            'id_laporan_pekerjaan' => $this->id_laporan_pekerjaan,
            'id_template_pekerjaan_detail' => $id_laporan_pekerjaan_detail,
        ], [
            'id_laporan_pekerjaan' => $this->id_laporan_pekerjaan,
            'id_template_pekerjaan_detail' => $id_laporan_pekerjaan_detail,
            'keterangan' => $keterangan
        ]);

        $message = 'Berhasil menyimpan keterangan';
        activity()->causedBy(HelperController::user())->log("Update keterangan laporan perawatan lift");
        return session()->flash('success', $message);
    }

    public function setKondisi($kondisi, $id_template_pekerjaan_detail){
        LaporanPekerjaanChecklist::updateOrCreate([
            'id_laporan_pekerjaan' => $this->id_laporan_pekerjaan,
            'id_template_pekerjaan_detail' => $id_template_pekerjaan_detail
        ], [
            'id_laporan_pekerjaan' => $this->id_laporan_pekerjaan,
            'id_template_pekerjaan_detail' => $id_template_pekerjaan_detail,
            'kondisi' => $kondisi
        ]);

        $message = 'Berhasil menyimpan data';
        activity()->causedBy(HelperController::user())->log("Set konfisi lift");
        return session()->flash('success', $message);
    }

    public function changeStatus($id_template_pekerjaan_detail){
        $laporanPekerjaanChecklist = LaporanPekerjaanChecklist::where('id_laporan_pekerjaan', $this->id_laporan_pekerjaan)
        ->where('id_template_pekerjaan_detail', $id_template_pekerjaan_detail)->first();
        if($laporanPekerjaanChecklist){
            $laporanPekerjaanChecklist->update([
                'status' => $laporanPekerjaanChecklist->status == 1 ? 0 : 1,
            ]);
        }else{
            LaporanPekerjaanChecklist::create([
                'id_laporan_pekerjaan' => $this->id_laporan_pekerjaan,
                'id_template_pekerjaan_detail' => $id_template_pekerjaan_detail,
                'status' => 1
            ]);
        }

        $message = "Berhasil menyimpan data";
        activity()->causedBy(HelperController::user())->log("Update status perawatan lift");
        return session()->flash('success', $message);
    }
}
