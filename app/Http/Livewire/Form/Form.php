<?php

namespace App\Http\Livewire\Form;

use App\Http\Controllers\HelperController;
use App\Models\FormMaster;
use Livewire\Component;

class Form extends Component
{
    public $listeners = ['simpanForm', 'setDataForm'];
    public $id_form;
    public $kode;
    public $nama;
    public $keterangan;
    public $periode_master;

    public function render()
    {
        $this->dispatchBrowserEvent('contentChange');

        return view('livewire.form.form');
    }

    public function simpanForm()
    {
        $this->validate([
            'kode' => 'required|string',
            'nama' => 'required|string',
            'keterangan' => 'nullable|string',
            'periode_master' => 'required',
        ], [
            'kode.required' => 'Kode form tidak boleh kosong',
            'kode.string' => 'Kode form tidak valid !',
            'nama.required' => 'Nama form tidak boleh kosong',
            'nama.string' => 'Nama form tidak valid !',
            'keterangan.string' => 'Keterangan tidak valid !',
            'periode_master.required' => 'Periode Belum dipilih !',
        ]);

        FormMaster::updateOrCreate([
            'id' => $this->id_form,
        ], [
            'kode' => $this->kode,
            'nama' => $this->nama,
            'periode' => json_encode($this->periode_master),
            'keterangan' => $this->keterangan,
        ]);

        $message = 'Data form berhasil disimpan';
        activity()->causedBy(HelperController::user())->log("Menambah / mengupdate data form master");
        $this->resetInputFields();
        $this->emit('refreshForm');
        $this->emit('finishSimpanData', 1, $message);

        return session()->flash('success', $message);
    }

    public function resetInputFields()
    {
        $this->id_form = null;
        $this->kode = null;
        $this->nama = null;
        $this->periode_master = null;
        $this->keterangan = null;
    }

    public function setDataForm($id)
    {
        $formMaster = FormMaster::find($id);
        if (!$formMaster) {
            $message = 'Data Form tidak ditemukan !';

            return session()->flash('fail', $message);
        }

        $this->id_form = $formMaster->id;
        $this->kode = $formMaster->kode;
        $this->nama = $formMaster->nama;
        $this->keterangan = $formMaster->keterangan;
        $this->periode_master = json_decode($formMaster->periode);
    }
}
