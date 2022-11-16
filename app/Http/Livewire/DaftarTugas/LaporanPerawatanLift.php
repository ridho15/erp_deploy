<?php

namespace App\Http\Livewire\DaftarTugas;

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
        'setKondisi1',
        'setKondisi2',
        'setKondisi3',
        'setKondisi6',
        'setKondisi12',
        'setPekerjaan',
        'setStatus',
        'simpanKeterangan'
    ];
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
        $this->listTemplatePekerjaan = TemplatePekerjaan::where('id_form_master', $this->laporanPekerjaan->id_form_master)->get();
        $this->dispatchBrowserEvent('contentChange');
        $this->listLaporanPekerjaanChecklist = LaporanPekerjaanChecklist::where('id_laporan_pekerjaan', $this->id_laporan_pekerjaan)->get();
        $this->periode = $this->laporanPekerjaan->periode;

        return view('livewire.daftar-tugas.laporan-perawatan-lift');
    }

    public function mount($id_laporan_pekerjaan)
    {
        $this->id_laporan_pekerjaan = $id_laporan_pekerjaan;
        $this->laporanPekerjaan = LaporanPekerjaan::find($this->id_laporan_pekerjaan);
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
        $this->resetInputFields();
        $this->emit('finishSimpanData', 1, $message);

        return session()->flash('success', $message);
    }

    public function setPekerjaan()
    {
        $detailList = TemplatePekerjaanDetail::find($this->templateListId);
        $detailList->keterangan = $this->pekerjaan;
        $detailList->save();

        $message = 'Berhasil menambah jenis pekerjaan';
        $this->emit('finishSimpanData', 1, $message);

        // return session()->flash('success', $message);
    }

    public function setStatus()
    {
        $detailList = TemplatePekerjaanDetail::find($this->templateListId);
        $detailList->status = $this->statusPekerjaan;
        $detailList->save();

        $message = 'Berhasil merubah status pekerjaan';
        $this->emit('finishSimpanData', 1, $message);

        // return session()->flash('success', $message);
    }

    public function setKondisi1($periode, $id_kondisi, $id_laporan_pekerjaan_detail)
    {
        $laporanPekerjaanChecklist = LaporanPekerjaanChecklist::updateOrCreate([
            'id_laporan_pekerjaan' => $this->id_laporan_pekerjaan,
            'id_template_pekerjaan_detail' => $id_laporan_pekerjaan_detail,
        ], [
            'id_laporan_pekerjaan' => $this->id_laporan_pekerjaan,
            'id_template_pekerjaan_detail' => $id_laporan_pekerjaan_detail,
        ]);

        if($id_kondisi == ""){
            $id_kondisi = null;
        }

        PerawatanLiftKondisi::updateOrCreate([
            'periode' => $periode,
            'id_laporan_pekerjaan_checklist' => $laporanPekerjaanChecklist->id
        ], [
            'periode' => $periode,
            'id_laporan_pekerjaan_checklist' => $laporanPekerjaanChecklist->id,
            'id_kondisi' => $id_kondisi
        ]);

        $message = 'Berhasil merubah kondisi Periode Bulan ke - 1';
        $this->emit('finishSimpanData', 1, $message);

        return session()->flash('success', $message);
    }

    public function setKondisi2($periode, $id_kondisi, $id_laporan_pekerjaan_detail)
    {
        $laporanPekerjaanChecklist = LaporanPekerjaanChecklist::updateOrCreate([
            'id_laporan_pekerjaan' => $this->id_laporan_pekerjaan,
            'id_template_pekerjaan_detail' => $id_laporan_pekerjaan_detail,
        ], [
            'id_laporan_pekerjaan' => $this->id_laporan_pekerjaan,
            'id_template_pekerjaan_detail' => $id_laporan_pekerjaan_detail,
        ]);

        if($id_kondisi == ""){
            $id_kondisi = null;
        }

        PerawatanLiftKondisi::updateOrCreate([
            'periode' => $periode,
            'id_laporan_pekerjaan_checklist' => $laporanPekerjaanChecklist->id
        ], [
            'periode' => $periode,
            'id_laporan_pekerjaan_checklist' => $laporanPekerjaanChecklist->id,
            'id_kondisi' => $id_kondisi
        ]);

        $message = 'Berhasil merubah kondisi Periode Bulan ke - 2';
        $this->emit('finishSimpanData', 1, $message);

        return session()->flash('success', $message);
    }

    public function setKondisi3($periode, $id_kondisi, $id_laporan_pekerjaan_detail)
    {
        $laporanPekerjaanChecklist = LaporanPekerjaanChecklist::updateOrCreate([
            'id_laporan_pekerjaan' => $this->id_laporan_pekerjaan,
            'id_template_pekerjaan_detail' => $id_laporan_pekerjaan_detail,
        ], [
            'id_laporan_pekerjaan' => $this->id_laporan_pekerjaan,
            'id_template_pekerjaan_detail' => $id_laporan_pekerjaan_detail,
        ]);

        if($id_kondisi == ""){
            $id_kondisi = null;
        }

        PerawatanLiftKondisi::updateOrCreate([
            'periode' => $periode,
            'id_laporan_pekerjaan_checklist' => $laporanPekerjaanChecklist->id
        ], [
            'periode' => $periode,
            'id_laporan_pekerjaan_checklist' => $laporanPekerjaanChecklist->id,
            'id_kondisi' => $id_kondisi
        ]);

        $message = 'Berhasil merubah kondisi Periode Bulan ke - 3';
        $this->emit('finishSimpanData', 1, $message);

        return session()->flash('success', $message);
    }

    public function setKondisi6($periode, $id_kondisi, $id_laporan_pekerjaan_detail)
    {
        $laporanPekerjaanChecklist = LaporanPekerjaanChecklist::updateOrCreate([
            'id_laporan_pekerjaan' => $this->id_laporan_pekerjaan,
            'id_template_pekerjaan_detail' => $id_laporan_pekerjaan_detail,
        ], [
            'id_laporan_pekerjaan' => $this->id_laporan_pekerjaan,
            'id_template_pekerjaan_detail' => $id_laporan_pekerjaan_detail,
        ]);


        if($id_kondisi == ""){
            $id_kondisi = null;
        }
        PerawatanLiftKondisi::updateOrCreate([
            'periode' => $periode,
            'id_laporan_pekerjaan_checklist' => $laporanPekerjaanChecklist->id
        ], [
            'periode' => $periode,
            'id_laporan_pekerjaan_checklist' => $laporanPekerjaanChecklist->id,
            'id_kondisi' => $id_kondisi
        ]);

        $message = 'Berhasil merubah kondisi Periode Bulan ke - 6';
        $this->emit('finishSimpanData', 1, $message);

        return session()->flash('success', $message);
    }

    public function setKondisi12($periode, $id_kondisi, $id_laporan_pekerjaan_detail)
    {
        $laporanPekerjaanChecklist = LaporanPekerjaanChecklist::updateOrCreate([
            'id_laporan_pekerjaan' => $this->id_laporan_pekerjaan,
            'id_template_pekerjaan_detail' => $id_laporan_pekerjaan_detail,
        ], [
            'id_laporan_pekerjaan' => $this->id_laporan_pekerjaan,
            'id_template_pekerjaan_detail' => $id_laporan_pekerjaan_detail,
        ]);

        if($id_kondisi == ""){
            $id_kondisi = null;
        }

        PerawatanLiftKondisi::updateOrCreate([
            'periode' => $periode,
            'id_laporan_pekerjaan_checklist' => $laporanPekerjaanChecklist->id
        ], [
            'periode' => $periode,
            'id_laporan_pekerjaan_checklist' => $laporanPekerjaanChecklist->id,
            'id_kondisi' => $id_kondisi
        ]);

        $message = 'Berhasil merubah kondisi Periode Bulan ke - 12';
        $this->emit('finishSimpanData', 1, $message);

        return session()->flash('success', $message);
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
        $this->emit('finishSimpanData', 1, $message);

        return session()->flash('success', $message);
    }
}
