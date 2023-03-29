<?php

namespace App\Http\Livewire\Kostumer;

use App\Http\Controllers\HelperController;
use App\Models\Kostumer;
use Livewire\Component;
use Livewire\WithPagination;

class Data extends Component
{
    use WithPagination;
    public $paginationTheme = 'bootstrap';
    public $listeners = ['refreshDataKostumer' => '$refresh', 'hapusKostumer'];
    public $total_show;
    public $cari;
    protected $listKostumer;
    public $id_barang_customer;
    public function render()
    {
        $this->listKostumer = Kostumer::where(function($query){
            $query->where('nama', 'LIKE', '%' . $this->cari . '%')
            ->orWhere('no_hp_1', 'LIKE', '%' . $this->cari . '%')
            ->orWhere('no_hp_2', 'LIKE', '%' . $this->cari . '%')
            ->orWhere('telp_1', 'LIKE', '%' . $this->cari . '%')
            ->orWhere('telp_2', 'LIKE', '%' . $this->cari . '%')
            ->orWhere('alamat', 'LIKE', '%' . $this->cari . '%')
            ->orWhere('email', 'LIKE', '%' . $this->cari . '%')
            ->orWhere('pic', 'LIKE', '%' . $this->cari . '%')
            ->orWhere('barang_customer', 'LIKE', '%' . $this->cari . '%')
            ->orWhere('ppn', 'LIKE', '%' . $this->cari . '%');
        })->paginate($this->total_show);
        $data['listKostumer'] = $this->listKostumer;
        return view('livewire.kostumer.data', $data);
    }

    public function mount(){

    }

    public function hapusKostumer($id){
        $kostumer = Kostumer::find($id);
        if(!$kostumer){
            $message = "Data custumer tidak ditemukan !";
            $this->emit('finishDataKostumer', 0, $message);
            return session()->flash('fail', $message);
        }

        $kostumer->delete();
        $message = "Data Customer berhasil dihapus";
        activity()->causedBy(HelperController::user())->log("Data customer berhasil di hapus");
        $this->emit('finishDataKostumer', 1, $message);
        return session()->flash('success', $message);
    }
}
