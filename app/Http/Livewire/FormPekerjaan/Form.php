<?php

namespace App\Http\Livewire\FormPekerjaan;

use App\Models\Customer;
use App\Models\Project;
use Livewire\Component;

class Form extends Component
{
    public $listeners = ['simpanDataProject', 'setDataProject'];
    public $id_project;
    public $nama_project;
    public $id_customer;
    public $alamat_project;
    public $keterangan_project;
    public $diketahui_pelanggan;

    public $listCustomer;
    public function render()
    {
        $this->listCustomer = Customer::where('status', 1)->get();
        return view('livewire.form-pekerjaan.form');
    }

    public function mount(){

    }

    public function simpanDataProject(){
        $this->validate([
            'nama_project' => 'nullable|string',
            'id_customer' => 'nullable|numeric',
            'alamat_project' => 'nullable|string',
            'keterangan_project' => 'nullable|string',
            'diketahui_pelanggan' => 'nullable|numeric'
        ], [
            'nama_project.string' => 'Nama project tidak valid !',
            'id_customer.numeric' => 'Customer tidak valid !',
            'alamat_project.string' => 'Alamat project tidak valid !',
            'keterangan_project.string' => 'Keterangan project tidak valid !',
            'diketahui_pelanggan.numeric' => 'Acc Pelanggan tidak valid !'
        ]);

        // Check Customer
        if($this->id_customer){
            $customer = Customer::find($this->id_customer);
            if(!$customer){
                $message = "Data customer tidak ditemukan !";
                return session()->flash('fail', $message);
            }
        }
        Project::updateOrCreate([
            'id' => $this->id_project
        ], [
            'nama_project' => $this->nama_project,
            'id_customer' => $this->id_customer,
            'alamat_project' => $this->alamat_project,
            'keterangan_project' => $this->keterangan_project,
            'diketahui_pelanggan' => $this->diketahui_pelanggan ? 1 : 0,
        ]);

        $message = "Berhasil menyimpan data project";
        $this->resetInputFields();
        $this->emit('refreshDataProject');
        $this->emit('finishSimpanData', 1, $message);

        return session()->flash('success', $message);
    }

    public function resetInputFields(){
        $this->id_project = null;
        $this->nama_project = null;
        $this->id_customer = null;
        $this->alamat_project = null;
        $this->keterangan_project = null;
        $this->diketahui_pelanggan = null;
    }

    public function setDataProject($id){
        $project = Project::find($id);
        if(!$project){
            $message = "Data project tidak ditemukan !";
            return session()->flash('fail', $message);
        }

        $this->id_project = $project->id;
        $this->nama_project = $project->nama_project;
        $this->id_customer = $project->id_customer;
        $this->alamat_project = $project->alamat_project;
        $this->keterangan_project = $project->keterangan_project;
        $this->diketahui_pelanggan = $project->diketahui_pelanggan;
    }
}
