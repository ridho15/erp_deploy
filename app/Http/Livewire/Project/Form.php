<?php

namespace App\Http\Livewire\Project;

use App\Http\Controllers\HelperController;
use App\Models\Customer;
use App\Models\ProjectV2;
use App\Models\Sales;
use App\Models\SalesProject;
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
    public $tanggal;
    public $map;
    public $listIdSales = [];
    public $total_pekerjaan;

    public $listSales = [];
    public function render()
    {
        $this->listCustomer = Customer::get();
        $this->listSales = Sales::get();
        $this->dispatchBrowserEvent('contentChange');
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
            'id_customer' => 'required|numeric',
            'tanggal' => 'nullable|string',
            'map' => 'nullable|string',
            'total_pekerjaan' => 'required|numeric'
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
            'id_customer.numeric' => 'Client tidak valid !',
            'tanggal.string' => 'Tanggal tidak valid !',
            'map.string' => 'Map tidak valid !',
            'total_pekerjaan.required' => 'Total Pekerjaan tidak boleh kosong',
            'total_pekerjaan.numeric' => 'Total pekerjaan tidak valid !'
        ]);

        $customer = Customer::find($this->id_customer);
        if(!$customer){
            $message = "Customer tidak ditemukan !";
            return session()->flash('fail', $message);
        }

        $project = ProjectV2::updateOrCreate([
            'id' => $this->id_project
        ], [
            'kode' => $this->kode,
            'nama' => $this->nama,
            'no_unit' => $this->no_unit,
            'no_mfg' => $this->no_mfg,
            'alamat' => $this->alamat,
            'catatan' => $this->catatan,
            'id_customer' => $this->id_customer,
            'map' => $this->map,
            'tanggal' => date('Y-m-d', strtotime($this->tanggal)),
            'total_pekerjaan' => $this->total_pekerjaan
        ]);

        SalesProject::where('id_project', $project->id)->delete();
        foreach ($this->listIdSales as $item) {
            SalesProject::create([
                'id_sales' => $item,
                'id_project' => $project->id
            ]);
        }

        $message = "Berhasil menyimpan data";
        activity()->causedBy(HelperController::user())->log("Menyimpan data project");

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
        $this->map = null;
        $this->listIdSales = [];
        $this->tanggal = null;
        $this->total_pekerjaan = null;
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
        $this->map = $project->map;
        $this->tanggal = $project->tanggal;
        $this->total_pekerjaan = $project->total_pekerjaan;

        $this->listIdSales = [];
        foreach ($project->salesProject as $item) {
            array_push($this->listIdSales, $item->id_sales);
        }
    }
}
