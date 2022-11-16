<?php

namespace App\Http\Livewire\TemplatePekerjaan;

use App\Models\Kondisi;
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
    public $keterangan = [];
    public $listTemplatePekerjaan;

    public $periode;
    public $kondisi;

    public $listKondisi;

    public function render()
    {
        $this->listKondisi = Kondisi::get();
        $this->listTemplatePekerjaan = TemplatePekerjaan::get();

        $this->dispatchBrowserEvent('contentChange');
        return view('livewire.template-pekerjaan.form-detail');
    }

    public function setIdTemplatePekerjaan($id_template_pekerjaan)
    {
        $this->id_template_pekerjaan = $id_template_pekerjaan;
    }

    public function simpanDetailPekerjaan()
    {
        $this->validate([
            'id_template_pekerjaan' => 'required|numeric',
            'nama_pekerjaan' => 'required|string',
            'periode' => 'required|numeric'
        ], [
            'id_template_pekerjaan.required' => 'Induk Pekerjaan belum dipilih',
            'id_template_pekerjaan.numeric' => 'Induk Pekerjaan tidak valid !',
            'nama_pekerjaan.required' => 'Nama pekerjaan tidak boleh kosong',
            'nama_pekerjaan.string' => 'Nama pekerjaan tidak valid !',
            'periode.required' => 'Periode belum dipilih',
            'periode.numeric' => 'Periode tidak valid !'
        ]);

        $templatePekerjaan = TemplatePekerjaan::find($this->id_template_pekerjaan);
        if (!$templatePekerjaan) {
            $message = 'Data pekerjaan tidak ditemukan !';

            return session()->flash('fail', $message);
        }

        TemplatePekerjaanDetail::updateOrCreate([
            'id' => $this->id_template_pekerjaan_detail,
        ], [
            'id_template_pekerjaan' => $this->id_template_pekerjaan,
            'nama_pekerjaan' => $this->nama_pekerjaan,
            'periode' => $this->periode,
            'kondisi' => json_encode($this->kondisi)
        ]);

        $message = 'Berhasil menyimpan data';
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
        $this->keterangan = $detailPekerjaan->keterangan;
        $this->kondisi = json_decode($detailPekerjaan->kondisi);
        $this->periode = $detailPekerjaan->periode;
    }
}
