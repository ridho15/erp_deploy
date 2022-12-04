<?php

namespace App\Http\Livewire\MetodePembayaran;

use App\Http\Controllers\HelperController;
use App\Models\MetodePembayaran;
use Livewire\Component;

class Data extends Component
{
    public $listeners = [
        'refreshMetodePembayaran' => '$refresh',
        'hapusMetodePembayaran'
    ];
    public $listMetodePembayaran;
    public $cari;
    public function render()
    {
        $this->listMetodePembayaran = MetodePembayaran::where(function($query){
            $query->where('nama_metode', 'LIKE', '%' . $this->cari . '%')
            ->orWhere('nilai', 'LIKE', '%' . $this->cari . '%');
        })->get();
        return view('livewire.metode-pembayaran.data');
    }

    public function mount(){

    }

    public function hapusMetodePembayaran($id){
        $metodePembayaran = MetodePembayaran::find($id);
        if(!$metodePembayaran){
            $message = "Data Metode Pembayaran tidak ditemukan !";
            return session()->flash('fail', $message);
        }

        $metodePembayaran->delete();
        $message = "Metode Pembayaran berhasil di hapus";
        activity()->causedBy(HelperController::user())->log("Menghapus data kategori");
        return session()->flash('success', $message);
    }
}
