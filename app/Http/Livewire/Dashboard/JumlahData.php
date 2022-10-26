<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Barang;
use App\Models\Customer;
use App\Models\CustomerOrder;
use App\Models\PreOrder;
use App\Models\Project;
use App\Models\Supplier;
use App\Models\User;
use Livewire\Component;

class JumlahData extends Component
{
    public $barang;
    public $customers;
    public $users;
    public $suplier;
    public $project;
    public $preOrder;
    public $customerOrder;

    public function render()
    {
        return view('livewire.dashboard.jumlah-data');
    }

    public function mount()
    {
        $this->barang = Barang::all()->count();
        $this->customers = Customer::all()->count();
        $this->users = User::all()->count();
        $this->suplier = Supplier::all()->count();
        $this->project = Project::all()->count();
        $this->preOrder = PreOrder::all()->count();
        $this->customerOrder = CustomerOrder::all()->count();
    }
}
