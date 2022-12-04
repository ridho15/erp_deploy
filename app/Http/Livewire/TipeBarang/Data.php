<?php

namespace App\Http\Livewire\TipeBarang;

use App\Http\Controllers\HelperController;
use App\Models\TipeBarang;
use Livewire\Component;

class Data extends Component
{
    public $listeners = ['refreshTipeBarang' => '$refresh', 'hapusTipeBarang'];
    public $listTipeBarang = [];
    public function render()
    {
        $this->listTipeBarang = TipeBarang::get();
        return view('livewire.tipe-barang.data');
    }

    public function mount(){

    }

    public function hapusTipeBarang($id){
        $tipeBarang = TipeBarang::find($id);
        if(!$tipeBarang){
            $message = "Data tipe barang tidak ditemukan";
            return session()->flash('fail', $message);
        }

        $tipeBarang->delete();
        $message = "Berhasil menghapus data tipe barang";
        activity()->causedBy(HelperController::user())->log("Menghapus data tipe barang");
        $this->emit('refreshData', 1, $message);
        return session()->flash('success', $message);
    }
}
