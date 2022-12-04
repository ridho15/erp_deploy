<?php

namespace App\Http\Livewire\BarangCustomer;

use App\Http\Controllers\HelperController;
use App\Models\BarangCustomer;
use Livewire\Component;
use Livewire\WithPagination;

class Data extends Component
{
    use WithPagination;
    public $listeners = [
        'refreshBarangCustomer' => '$refresh',
        'hapusBarangCustomer'
    ];

    public $cari;
    public $total_show = 10;
    protected $listBarangCustomer;
    public function render()
    {
        $this->listBarangCustomer = BarangCustomer::where(function($query){
            $query->where('nama_barang', 'LIKE', '%' . $this->cari . '%');
        })->paginate($this->total_show);

        $data['listBarangCustomer'] = $this->listBarangCustomer;
        return view('livewire.barang-customer.data', $data);
    }

    public function mount(){

    }

    public function hapusBarangCustomer($id){
        $barangCustomer = BarangCustomer::find($id);
        if(!$barangCustomer){
            $message = "Data barang customer tidak ditemukan !";
            return session()->flash('fail', $message);
        }

        $barangCustomer->delete();
        $message = "Data berhasil di hapus";
        activity()->causedBy(HelperController::user())->log("Menghapus barang customer");
        return session()->flash('success', $message);
    }
}
