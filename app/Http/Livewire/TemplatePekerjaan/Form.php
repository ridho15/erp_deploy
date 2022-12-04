<?php

namespace App\Http\Livewire\TemplatePekerjaan;

use App\Http\Controllers\HelperController;
use App\Models\FormMaster;
use App\Models\Kondisi;
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

    public $listKondisi;
    public $listPekerjaan = [];
    public $periode;
    public $id_parent;

    public function render()
    {
        $this->listKondisi = Kondisi::get();
        $this->listFormMaster = FormMaster::get();
        $this->listPekerjaan = TemplatePekerjaan::where(function($query){
            $query->where('id_form_master', $this->id_form_master);
        })
        ->get();
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
            'id_form_master' => 'nullable|numeric',
            'nama_pekerjaan' => 'required|string',
            'periode.*' => 'nullable|numeric',
            'id_parent' => 'nullable|numeric',
        ], [
            'id_form_master.required' => 'Form master belum dipilih !',
            'id_form_master.numeric' => 'Form master tidak valid !',
            'nama_pekerjaan.required' => 'Nama pekerjaan tidak boleh kosong',
            'nama_pekerjaan.string' => 'Nama pekerjaan tidak valid !',
            'periode.*.numeric' => 'Periode tidak valid !',
            'id_parent.numeric' => 'Parent pekerjaan tidak valid !'
        ]);

        $formMaster = FormMaster::find($this->id_form_master);
        if (!$formMaster) {
            $message = 'Form Master tidak ditemukan !';

            return session()->flash('fail', $message);
        }
        if($this->id_parent == $this->id_template_pekerjaan){
            $this->id_parent = null;
        }

        if($this->id_parent == null && $this->id_form_master == null){
            $message = "Form master atau Parent tidak boleh kosong, Tolong isi salah satunya";
            return session()->flash('fail', $message);
        }

        if($this->id_parent == null){
            $data['id_form_master'] = $this->id_form_master;
        }else{
            $data['id_parent'] = $this->id_parent;
        }
        $data['nama_pekerjaan'] = $this->nama_pekerjaan;
        $data['keterangan'] = $this->keterangan;
        $data['periode'] = json_encode($this->periode);

        TemplatePekerjaan::updateOrCreate([
            'id' => $this->id_template_pekerjaan,
        ], $data);

        $message = 'Berhasil menyimpan data';
        activity()->causedBy(HelperController::user())->log("Menyimpan Template Pekerjaan");
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
        $this->id_parent = null;
        $this->periode = null;
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
        $this->id_parent = $templatePekerjaan->id_parent;
        $this->periode = json_decode($templatePekerjaan->periode);
        if($templatePekerjaan->parent){
            $this->id_form_master = $templatePekerjaan->parent->id_form_master;
        }
    }
}
