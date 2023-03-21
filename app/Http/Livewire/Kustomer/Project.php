<?php

namespace App\Http\Livewire\Kustomer;

use App\Models\Customer;
use App\Models\Kostumer;
use App\Models\ProjectV2;
use Livewire\Component;

class Project extends Component
{
    public $listProject = [];
    public $id_customer;
    public $kostumer;
    public $cari;
    public function render()
    {
        $this->listProject = ProjectV2::where('id_customer', $this->id_customer)
        ->where(function($query){
            $query->where('kode', 'LIKE', '%' . $this->cari . '%')
            ->orWhere('nama', 'LIKE', '%' . $this->cari . '%')
            ->orWhere('no_unit', 'LIKE', '%' . $this->cari . '%');
        })->get();
        return view('livewire.kustomer.project');
    }

    public function mount($id_customer){
        $this->id_customer = $id_customer;
        $this->kostumer = Customer::find($this->id_customer);
    }
}
