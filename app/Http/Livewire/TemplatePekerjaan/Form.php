<?php

namespace App\Http\Livewire\TemplatePekerjaan;

use App\Models\FormMaster;
use App\Models\TemplatePekerjaan;
use Livewire\Component;

class Form extends Component
{
    public $listeners = [
        'setIdFormMaster',
        'simpanTemplatePekerjaan',
        'setDataTemplatePekerjaan',
    ];
    public $listFormMaster = [];
    public $id_template_pekerjaan;
    public $id_form_master;
    public $nama_pekerjaan;
    public $keterangan;

    public function render()
    {
        $this->listFormMaster = FormMaster::get();
        $this->dispatchBrowserEvent('contentChange');

        return view('livewire.template-pekerjaan.form');
    }

    public function mount()
    {
    }

    public function setIdFormMaster($id_form_master)
    {
        $this->id_form_master = $id_form_master;
    }

    public function simpanTemplatePekerjaan()
    {
        $this->validate([
            'id_form_master' => 'required|numeric',
            'nama_pekerjaan' => 'required|string',
        ], [
            'id_form_master.required' => 'Form master belum dipilih !',
            'id_form_master.numeric' => 'Form master tidak valid !',
            'nama_pekerjaan.required' => 'Nama pekerjaan tidak boleh kosong',
            'nama_pekerjaan.string' => 'Nama pekerjaan tidak valid !',
        ]);

        $formMaster = FormMaster::find($this->id_form_master);
        if (!$formMaster) {
            $message = 'Form Master tidak ditemukan !';

            return session()->flash('fail', $message);
        }

        TemplatePekerjaan::updateOrCreate([
            'id' => $this->id_template_pekerjaan,
        ], [
            'nama_pekerjaan' => $this->nama_pekerjaan,
            'keterangan' => json_encode([]),
            'id_form_master' => $this->id_form_master,
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
        $this->nama_pekerjaan = null;
        $this->keterangan = null;
        $this->id_form_master = null;
    }

    public function setDataTemplatePekerjaan($id)
    {
        $templatePekerjaan = TemplatePekerjaan::find($id);
        if (!$templatePekerjaan) {
            $message = 'Data tidak ditemukan !';

            return session()->flash('fail', $message);
        }

        $this->id_template_pekerjaan = $templatePekerjaan->id;
        $this->nama_pekerjaan = $templatePekerjaan->nama_pekerjaan;
        $this->keterangan = $templatePekerjaan->keterangan;
        $this->id_form_master = $templatePekerjaan->id_form_master;
    }
}
