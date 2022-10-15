<?php

namespace App\Http\Livewire\TemplatePekerjaan;

use App\Models\TemplatePekerjaan;
use App\Models\TemplatePekerjaanDetail;
use Livewire\Component;

class FormDetail extends Component
{
    public $listeners = [
        'setIdTemplatePekerjaan',
        'simpanDetailPekerjaan',
        'hapusDetailPekerjaan',
        'setDetailPekerjaan',
    ];
    public $id_template_pekerjaan_detail;
    public $id_template_pekerjaan;
    public $nama_pekerjaan;
    public $checklist_1_bulan;
    public $checklist_2_bulan;
    public $checklist_3_bulan;
    public $checklist_6_bulan;
    public $checklist_1_tahun;
    public $keterangan;
    public $listTemplatePekerjaan;

    public function render()
    {
        $this->listTemplatePekerjaan = TemplatePekerjaan::get();
        return view('livewire.template-pekerjaan.form-detail');
    }

    public function setIdTemplatePekerjaan($id_template_pekerjaan){
        $this->id_template_pekerjaan = $id_template_pekerjaan;
    }

    public function simpanDetailPekerjaan(){
        $this->validate([
            'id_template_pekerjaan' => 'required|numeric',
            'nama_pekerjaan' => 'required|string',
            'checklist_1_bulan' => 'nullable|numeric',
            'checklist_2_bulan' => 'nullable|numeric',
            'checklist_3_bulan' => 'nullable|numeric',
            'checklist_6_bulan' => 'nullable|numeric',
            'checklist_1_tahun' => 'nullable|numeric',
            'keterangan' => 'nullable|string',
        ], [
            'id_template_pekerjaan.required' => 'Induk Pekerjaan belum dipilih',
            'id_template_pekerjaan.numeric' => 'Induk Pekerjaan tidak valid !',
            'nama_pekerjaan.required' => 'Nama pekerjaan tidak boleh kosong',
            'nama_pekerjaan.string' => 'Nama pekerjaan tidak valid !',
            'checklist_1_bulan.numeric' => 'Checklist 1 Bulan tidak valid !',
            'checklist_2_bulan.numeric' => 'Checklist 2 Bulan tidak valid !',
            'checklist_3_bulan.numeric' => 'Checklist 3 Bulan tidak valid !',
            'checklist_6_bulan.numeric' => 'Checklist 6 Bulan tidak valid !',
            'checklist_1_tahun.numeric' => 'Checklist 1 tahun tidak valid !',
        ]);

        $templatePekerjaan = TemplatePekerjaan::find($this->id_template_pekerjaan);
        if(!$templatePekerjaan){
            $message = "Data pekerjaan tidak ditemukan !";
            return session()->flash('fail', $message);
        }

        TemplatePekerjaanDetail::updateOrCreate([
            'id' => $this->id_template_pekerjaan_detail
        ], [
            'id_template_pekerjaan' => $this->id_template_pekerjaan,
            'nama_pekerjaan' => $this->nama_pekerjaan,
            'checklist_1_bulan' => $this->checklist_1_bulan ? 1 : 0,
            'checklist_2_bulan' => $this->checklist_2_bulan ? 1 : 0,
            'checklist_3_bulan' => $this->checklist_3_bulan ? 1 : 0,
            'checklist_6_bulan' => $this->checklist_6_bulan ? 1 : 0,
            'checklist_1_tahun' => $this->checklist_1_tahun ? 1 : 0,
            'keterangan' => $this->keterangan
        ]);

        $message = "Berhasil menyimpan data";
        $this->resetInputFields();
        $this->emit('refreshTemplatePekerjaan');
        $this->emit('finishSimpanData', 1, $message);
        return session()->flash('success', $message);
    }

    public function resetInputFields(){
        $this->id_template_pekerjaan = null;
        $this->id_template_pekerjaan_detail = null;
        $this->nama_pekerjaan = null;
        $this->checklist_1_bulan = null;
        $this->checklist_2_bulan = null;
        $this->checklist_3_bulan = null;
        $this->checklist_6_bulan = null;
        $this->checklist_1_tahun = null;
        $this->keterangan = null;
    }

    public function hapusDetailPekerjaan($id){
        $detailPekerjaan = TemplatePekerjaanDetail::find($id);
        if(!$detailPekerjaan){
            $message = "Detail pekerjaan tidak ditemukan !";
            return session()->flash('fail', $message);
        }

        $detailPekerjaan->delete();
        $message = "Detail pekerjaan berhasil di hapus";
        $this->emit('refreshTemplatePekerjaan');
        return session()->flash('success', $message);
    }

    public function setDetailPekerjaan($id){
        $detailPekerjaan = TemplatePekerjaanDetail::find($id);
        if(!$detailPekerjaan){
            $message = "Detail Pekerjaan tidak ditemukan !";
            return session()->flash('fail', $message);
        }

        $this->id_template_pekerjaan_detail = $detailPekerjaan->id;
        $this->id_template_pekerjaan = $detailPekerjaan->id_template_pekerjaan;
        $this->nama_pekerjaan = $detailPekerjaan->nama_pekerjaan;
        $this->checklist_1_bulan = $detailPekerjaan->checklist_1_bulan;
        $this->checklist_2_bulan = $detailPekerjaan->checklist_2_bulan;
        $this->checklist_3_bulan = $detailPekerjaan->checklist_3_bulan;
        $this->checklist_6_bulan = $detailPekerjaan->checklist_6_bulan;
        $this->checklist_1_tahun = $detailPekerjaan->checklist_1_tahun;
        $this->keterangan = $detailPekerjaan->keterangan;
    }
}
