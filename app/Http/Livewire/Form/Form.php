<?php

namespace App\Http\Livewire\Form;

use App\Models\FormMaster;
use Livewire\Component;

class Form extends Component
{
    public $listeners = ['simpanForm', 'setDataForm'];
    public $id_form;
    public $kode;
    public $nama;
    public $keterangan;
    public $periode;

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
            'periode' => 'required',
        ], [
            'kode.required' => 'Kode form tidak boleh kosong',
            'kode.string' => 'Kode form tidak valid !',
            'nama.required' => 'Nama form tidak boleh kosong',
            'nama.string' => 'Nama form tidak valid !',
            'keterangan.string' => 'Keterangan tidak valid !',
            'periode.required' => 'Periode Belum dipilih !',
        ]);

        if ($this->id_form != 1) {
            FormMaster::updateOrCreate([
                'id' => $this->id_form,
            ], [
                'kode' => $this->kode,
                'nama' => $this->nama,
                'periode' => $this->periode,
                'keterangan' => $this->keterangan,
            ]);
        }

        $message = 'Data form berhasil disimpan';
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
        $this->periode = null;
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
        $this->periode = $formMaster->periode;
    }
}
