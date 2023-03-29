<?php

namespace App\Http\Livewire\Supplier;

use App\Http\Controllers\HelperController;
use App\Models\Supplier;
use Livewire\Component;
use Livewire\WithPagination;

class Data extends Component
{
    use WithPagination;
    public $paginationTheme = 'bootstrap';
    public $listeners = ['refreshDataSupplier' => '$refresh', 'hapusSupplier'];
    public $total_show;
    public $cari;
    protected $listSupplier;
    public function render()
    {
        $this->listSupplier = Supplier::where(function($query){
            $query->where('name', 'LIKE', '%' . $this->cari . '%')
            ->orWhere('no_hp_1', 'LIKE', '%' . $this->cari . '%')
            ->orWhere('no_hp_2', 'LIKE', '%' . $this->cari . '%')
            ->orWhere('telp_1', 'LIKE', '%' . $this->cari . '%')
            ->orWhere('telp_2', 'LIKE', '%' . $this->cari . '%')
            ->orWhere('alamat', 'LIKE', '%' . $this->cari . '%')
            ->orWhere('email', 'LIKE', '%' . $this->cari . '%');
        })->orderBy('created_at', 'DESC')->paginate($this->total_show);
        $data['listSupplier'] = $this->listSupplier;
        return view('livewire.supplier.data', $data);
    }

    public function mount(){

    }

    public function hapusSupplier($id){
        $supplier = Supplier::find($id);
        if(!$supplier){
            $message = "Data supplier tidak ditemukan !";
            $this->emit('finishDataSupplier', 0, $message);
            return session()->flash('fail', $message);
        }

        $supplier->delete();
        $message = "Data Supplier berhasil dihapus";
        activity()->causedBy(HelperController::user())->log("Menghapus data Supplier");
        $this->emit('finishDataSupplier', 1, $message);
        return session()->flash('success', $message);
    }
}
