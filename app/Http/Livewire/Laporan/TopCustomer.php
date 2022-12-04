<?php

namespace App\Http\Livewire\Laporan;

use App\Models\Customer;
use Livewire\Component;

class TopCustomer extends Component
{
    public $listCustomer;
    public $listData = [];
    public function render()
    {
        $this->listData = [];
        $this->listCustomer = Customer::get()->sortByDesc('total_order')->take(15);
        foreach ($this->listCustomer as $item) {
            array_push($this->listData, collect([
                'value' => $item->total_order,
                'category' => $item->nama
            ]));
        }
        $this->dispatchBrowserEvent('contentChangeGrafikCustomer');
        return view('livewire.laporan.top-customer');
    }

    public function mount(){

    }
}
