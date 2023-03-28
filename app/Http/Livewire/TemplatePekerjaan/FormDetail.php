<?php

namespace App\Http\Livewire\TemplatePekerjaan;

use App\Http\Controllers\HelperController;
use App\Models\Kondisi;
use App\Models\TemplatePekerjaan;
use App\Models\TemplatePekerjaanDetail;
use Livewire\Component;

class FormDetail extends Component
{
    public $listeners = [
        'setIdTemplatePekerjaan',
        'setIdTemplatePekerjaanDetail',
        'simpanDetailPekerjaan',
        'hapusDetailPekerjaan',
        'setDetailPekerjaan',
        'updateDetailPekerjaan',
        'setDataTemplatePekerjaanDetail',
        'setIsChild',
        'setTemplatePekerjaanDetailParent',
        'setIdParentTemplatePekerjaanDetail'
    ];
    public $id_form_master;
    public $id_template_pekerjaan_detail;
    public $id_template_pekerjaan;
    public $nama_pekerjaan;
    public $keterangan = [];
    public $listTemplatePekerjaan;

    public $periode;
    public $id_parent;
    public $is_child = false;

    public $listTemplatePekerjaanDetail;
    public $templatePekerjaanDetail;

    public $isUpdate = false;
    public $isParent = false;

    public function render()
    {
        if ($this->isParent == true) {
            $this->listTemplatePekerjaan = TemplatePekerjaan::where('id_form_master', $this->id_form_master)->get();
        } else {
            $this->listTemplatePekerjaan = TemplatePekerjaanDetail::where('id_parent', null)
                ->where('id', $this->id_template_pekerjaan_detail)->get();
        }

        $this->dispatchBrowserEvent('contentChange');
        return view('livewire.template-pekerjaan.form-detail');
    }

    public function mount($id_form_master = null)
    {
        $this->id_form_master = $id_form_master;
    }

    public function setIdTemplatePekerjaan($id_template_pekerjaan)
    {
        $this->isParent = true;
        $this->id_template_pekerjaan_detail = null;
        $this->id_template_pekerjaan = $id_template_pekerjaan;
    }

    public function setIdTemplatePekerjaanDetail($id_template_pekerjaan, $id_template_pekerjaan_detail)
    {
        $this->is_child = true;
        $this->id_template_pekerjaan = $id_template_pekerjaan;
        $this->id_template_pekerjaan_detail = $id_template_pekerjaan_detail;
    }

    public function simpanDetailPekerjaan()
    {
        $this->validate([
            'id_template_pekerjaan' => 'required|numeric',
            'nama_pekerjaan' => 'required|string',
        ], [
            'id_template_pekerjaan.required' => 'Induk Pekerjaan belum dipilih',
            'id_template_pekerjaan.numeric' => 'Induk Pekerjaan tidak valid !',
            'nama_pekerjaan.required' => 'Nama pekerjaan tidak boleh kosong',
            'nama_pekerjaan.string' => 'Nama pekerjaan tidak valid !',
        ]);

        $templatePekerjaan = TemplatePekerjaan::find($this->id_template_pekerjaan);
        if (!$templatePekerjaan) {
            $message = 'Data pekerjaan tidak ditemukan !';
            return session()->flash('fail', $message);
        }

        if ($this->isUpdate == true) {
            $templatePekerjaanDetail = TemplatePekerjaanDetail::find($this->id_template_pekerjaan_detail);
            $templatePekerjaanDetail->update(
                [
                    'id_template_pekerjaan' => $this->id_template_pekerjaan,
                    'nama_pekerjaan' => $this->nama_pekerjaan,
                    'periode' => json_encode($this->periode),
                ]
            );
        } else {
            TemplatePekerjaanDetail::create([
                'id_template_pekerjaan' => $this->id_parent ? null : $this->id_template_pekerjaan,
                'nama_pekerjaan' => $this->nama_pekerjaan,
                'periode' => json_encode($this->periode),
                'id_parent' => $this->id_parent
            ]);
        }

        $message = 'Berhasil menyimpan data';
        activity()->causedBy(HelperController::user())->log("Menyimpan detail pekerjaan");
        $this->resetInputFields();
        $this->emit('refreshTemplatePekerjaan');
        $this->emit('finishSimpanData', 1, $message);

        return session()->flash('success', $message);
    }

    public function resetInputFields()
    {
        $this->id_template_pekerjaan = null;
        $this->id_template_pekerjaan_detail = null;
        $this->nama_pekerjaan = null;
        $this->keterangan = null;
        $this->kondisi = null;
        $this->periode = null;
        $this->id_parent = null;
        $this->isUpdate = false;
        $this->is_parent = false;
        $this->templatePekerjaanDetail = null;
    }

    public function hapusDetailPekerjaan($id)
    {
        $detailPekerjaan = TemplatePekerjaanDetail::find($id);
        if (!$detailPekerjaan) {
            $message = 'Detail pekerjaan tidak ditemukan !';

            return session()->flash('fail', $message);
        }

        $detailPekerjaan->delete();
        $message = 'Detail pekerjaan berhasil di hapus';
        $this->emit('refreshTemplatePekerjaan');

        return session()->flash('success', $message);
    }

    public function setDetailPekerjaan($id, $periode)
    {
        $detailPekerjaan = TemplatePekerjaanDetail::find($id);
        if (!$detailPekerjaan) {
            $message = 'Detail Pekerjaan tidak ditemukan !';

            return session()->flash('fail', $message);
        }

        $this->periode = $periode;

        $this->id_template_pekerjaan_detail = $detailPekerjaan->id;
        $this->id_template_pekerjaan = $detailPekerjaan->id_template_pekerjaan;
        $this->nama_pekerjaan = $detailPekerjaan->nama_pekerjaan;
        $this->periode = $detailPekerjaan->periode;
        $this->id_parent = $detailPekerjaan->id_parent;
    }

    public function setDataTemplatePekerjaanDetail($id_template_pekerjaan_detail)
    {
        $templatePekerjaanDetail = TemplatePekerjaanDetail::find($id_template_pekerjaan_detail);
        if (!$templatePekerjaanDetail) {
            $message = "Data tidak ditemukan";
            return session()->flash('fail', $message);
        }

        // $this->id_template_pekerjaan = $templatePekerjaanDetail->id_template_pekerjaan;
        $this->id_template_pekerjaan_detail = $templatePekerjaanDetail->id;
        $this->nama_pekerjaan = $templatePekerjaanDetail->nama_pekerjaan;
        $this->periode = json_decode($templatePekerjaanDetail->periode);
        $this->isUpdate = true;
        $this->id_template_pekerjaan = $templatePekerjaanDetail->id_template_pekerjaan;
    }

    public function updateDetailPekerjaan()
    {
        $this->validate([
            'nama_pekerjaan' => 'required|string',
            'periode' => 'required|array'
        ]);

        $templatePekerjaanDetail = TemplatePekerjaanDetail::find($this->id_template_pekerjaan_detail);
        if ($templatePekerjaanDetail) {
            $templatePekerjaanDetail->update([
                'nama_pekerjaan' => $this->nama_pekerjaan,
                'periode' => json_encode($this->periode)
            ]);
        }

        $message = "Berhasil mengupdate data pekerjaan detail";
        $this->resetInputFields();
        $this->emit('refreshTemplatePekerjaan');
        $this->emit('finishSimpanData', 1, $message);
        return session()->flash('success', $message);
    }

    public function setIsChild()
    {
        $this->is_child = true;
    }

    public function setTemplatePekerjaanDetailParent($id_template_pekerjaan_detail)
    {
        $this->templatePekerjaanDetail = TemplatePekerjaanDetail::find($id_template_pekerjaan_detail);
        $this->id_template_pekerjaan = $this->templatePekerjaanDetail->id_template_pekerjaan;
        $this->id_template_pekerjaan_detail = $this->templatePekerjaanDetail->id;
        $this->nama_pekerjaan = $this->templatePekerjaanDetail->nama_pekerjaan;
        $this->periode = json_decode($this->templatePekerjaanDetail->periode);
        $this->isParent = true;
        $this->isUpdate = true;
    }

    public function setIdParentTemplatePekerjaanDetail($id_template_pekerjaan_detail)
    {
        $this->templatePekerjaanDetail = TemplatePekerjaanDetail::find($id_template_pekerjaan_detail);
        $this->id_parent = $id_template_pekerjaan_detail;
        $this->id_template_pekerjaan = $this->templatePekerjaanDetail->id_template_pekerjaan;
        $this->isParent = false;
        $this->isUpdate = false;
    }
}
