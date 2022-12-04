<?php

namespace App\Http\Livewire\Supplier;

use App\Http\Controllers\HelperController;
use App\Models\Supplier;
use App\Models\SupplierBarang;
use Livewire\Component;
use Livewire\WithPagination;

class Barang extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $listeners = ['refreshSupplierBarang' => '$refresh', 'hapusSupplierBarang'];
    public $id_supplier;
    public $supplier;
    public $total_show = 10;
    public $cari;
    protected $listSupplierBarang;
    public function render()
    {
        $this->supplier = Supplier::find($this->id_supplier);
        $this->listSupplierBarang = SupplierBarang::where(function($query){
            $query->whereHas('barang', function($query){
                $query->where('nama' ,'LIKE', '%' . $this->cari . '%');
            });
        })->where('id_supplier', $this->id_supplier)->paginate($this->total_show);
        $data['listSupplierBarang'] = $this->listSupplierBarang;
        return view('livewire.supplier.barang', $data);
    }

    public function mount($id_supplier){
        $this->id_supplier = $id_supplier;
    }

    public function hapusSupplierBarang($id){
        $supplierBarang = SupplierBarang::find($id);
        if(!$supplierBarang){
            $message = "Supplier barang tidak ditemukan !";

            return session()->flash('fail', $message);
        }

        $supplierBarang->delete();
        $message = "Berhasil menghapus supplier barang";
        activity()->causedBy(HelperController::user())->log("Menghapus Supplier Barang");

        return session()->flash('success', $message);
    }
}
