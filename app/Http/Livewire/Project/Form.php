<?php

namespace App\Http\Livewire\Project;

use App\Models\Customer;
use App\Models\ProjectV2;
use Livewire\Component;

class Form extends Component
{
    public $listeners = ['simpanProject', 'setDataProject'];
    public $id_project;
    public $kode;
    public $nama;
    public $no_unit;
    public $no_mfg;
    public $alamat;
    public $id_customer;
    public $catatan;
    public $listCustomer;
    public function render()
    {
        $this->listCustomer = Customer::get();
        return view('livewire.project.form');
    }

    public function mount(){

    }

    public function simpanProject(){
        $this->validate([
            'kode' => 'required|string',
            'nama' => 'required|string',
            'no_unit' => 'nullable|numeric',
            'no_mfg' => 'nullable|numeric',
            'alamat' => 'required|string',
            'catatan' => 'nullable|string',
            'id_customer' => 'required|numeric'
        ], [
            'kode.required' => 'Kode project tidak boleh kosong',
            'kode.string' => 'Kode tidak valid !',
            'nama.required' => 'Nama project tidak boleh kosong',
            'nama.string' => 'Nama tidak valid !',
            'no_unit.numeric' => 'Nomor unit tidak valid !',
            'no_mfg.numeric' => 'Nomor MFG tidak valid !',
            'alamat.required' => 'Alamat tidak boleh kosong',
            'alamat.string' => 'Alamat tidak valid !',
            'catatan.string' => 'Catatan tidak valid !',
            'id_customer.required' => 'Client Belum dipilih',
            'id_customer.numeric' => 'Client tidak valid !'
        ]);

        $customer = Customer::find($this->id_customer);
        if(!$customer){
            $message = "Customer tidak ditemukan !";
            return session()->flash('fail', $message);
        }

        ProjectV2::updateOrCreate([
            'id' => $this->id_project
        ], [
            'kode' => $this->kode,
            'nama' => $this->nama,
            'no_unit' => $this->no_unit,
            'no_mfg' => $this->no_mfg,
            'alamat' => $this->alamat,
            'catatan' => $this->catatan,
            'id_customer' => $this->id_customer
        ]);

        $message = "Berhasil menyimpan data";
        $this->resetInputFields();
        $this->emit('refreshProject');
        $this->emit('finishSimpanData', 1, $message);
        return session()->flash('success', $message);
    }

    public function resetInputFields(){
        $this->id_project = null;
        $this->kode = null;
        $this->nama = null;
        $this->no_unit = null;
        $this->no_mfg = null;
        $this->alamat = null;
        $this->catatan = null;
        $this->id_customer = null;
    }

    public function setDataProject($id){
        $project = ProjectV2::find($id);
        if(!$project){
            $message = "Data Project tidak ditemukan !";
            return session()->flash('fail', $message);
        }

        $this->id_project = $project->id;
        $this->kode = $project->kode;
        $this->nama = $project->nama;
        $this->no_unit = $project->no_unit;
        $this->no_mfg = $project->no_mfg;
        $this->alamat = $project->alamat;
        $this->catatan = $project->catatan;
        $this->id_customer = $project->id_customer;
    }
}
