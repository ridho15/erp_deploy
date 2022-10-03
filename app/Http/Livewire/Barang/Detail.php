<?php

namespace App\Http\Livewire\Barang;

use App\Models\Barang;
use Livewire\Component;

class Detail extends Component
{
    public $id_barang;
    public $barang;
    public function render()
    {
        $this->barang = Barang::find($this->id_barang);
        return view('livewire.barang.detail');
    }

    public function mount($id_barang){
        $this->id_barang = $id_barang;
    }
}
