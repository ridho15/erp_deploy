<?php

namespace App\Http\Livewire\FormPekerjaan;

use App\Http\Controllers\HelperController;
use App\Models\Customer;
use App\Models\Project;
use App\Models\Quotation;
use Livewire\Component;

class Form extends Component
{
    public $listeners = [
        'simpanDataProject',
        'setDataProject',
        'changeCustomer'
    ];
    public $id_project;
    public $nama_project;
    public $id_customer;
    public $alamat_project;
    public $keterangan_project;
    public $diketahui_pelanggan;
    public $status;
    public $nomor_lift;

    public $listCustomer;
    public function render()
    {
        $this->listCustomer = Customer::where('status', 1)->get();
        $this->dispatchBrowserEvent('contentChange');
        return view('livewire.form-pekerjaan.form');
    }

    public function mount(){

    }

    public function simpanDataProject(){
        $this->validate([
            'nama_project' => 'required|string',
            'id_customer' => 'nullable|numeric',
            'alamat_project' => 'nullable|string',
            'keterangan_project' => 'nullable|string',
            'nomor_lift' => 'nullable|string'
        ], [
            'nama_project.required' => 'Nama project tidak boleh kosong',
            'nama_project.string' => 'Nama project tidak valid !',
            'id_customer.numeric' => 'Customer tidak valid !',
            'alamat_project.string' => 'Alamat project tidak valid !',
            'keterangan_project.string' => 'Keterangan project tidak valid !',
            'nomor_lift.string' => 'Nomor lift tidak valid !'
        ]);

        // Check Customer
        if($this->id_customer){
            $customer = Customer::find($this->id_customer);
            if(!$customer){
                $message = "Data customer tidak ditemukan !";
                return session()->flash('fail', $message);
            }
        }
        $project = Project::updateOrCreate([
            'id' => $this->id_project
        ], [
            'nama_project' => $this->nama_project,
            'id_customer' => $this->id_customer,
            'alamat_project' => $this->alamat_project,
            'keterangan_project' => $this->keterangan_project,
            'diketahui_pelanggan' => $this->diketahui_pelanggan ? 1 : 0,
            'status' => $this->status ? 1 : 0,
            'nomor_lift' => $this->nomor_lift
        ]);

        if($this->status == 1){
            Quotation::updateOrCreate([
                'id_project' => $project->id,
            ], [
                'id_project' => $project->id,
                'status_respons' => 0,
            ]);
            $message = "Berhasil menyimpan data. Silahkan check quotation untuk melakukan pengiriman quotation ke pelanggan";
        }else{
            $message = "Berhasil menyimpan data project";
        }
        activity()->causedBy(HelperController::user())->log("Menyimpan data project");
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
        $this->status = null;
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
        $this->status = $project->status;
    }

    public function changeCustomer($id_customer){
        $this->id_customer = $id_customer;
    }
}
