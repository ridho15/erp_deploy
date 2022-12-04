<?php

namespace App\Http\Livewire\Supplier;

use App\Http\Controllers\HelperController;
use App\Models\Barang;
use App\Models\Supplier;
use App\Models\SupplierBarang;
use Livewire\Component;

class TambahBarang extends Component
{
    public $listeners = ['simpanSupplierBarang', 'setIdSupplier', 'setIdBarang'];
    public $id_supplier;
    public $id_barang;
    public $listBarang;
    public $listSupplier;
    public function render()
    {
        $this->listSupplier = Supplier::get();
        $this->listBarang = Barang::get();
        $this->dispatchBrowserEvent('contentChange');
        return view('livewire.supplier.tambah-barang');
    }

    public function mount(){

    }

    public function simpanSupplierBarang(){
        $this->validate([
            'id_supplier' => 'required|numeric',
            'id_barang' => 'required|numeric'
        ], [
            'id_supplier.required' => 'Supplier belum dipilih',
            'id_supplier.numeric' => 'Supplier tidak valid !',
            'id_barang.required' => 'Barang belum dipilih',
            'id_barang.numeric' => 'Barang tidak valid !'
        ]);

        $supplier = Supplier::find($this->id_supplier);
        if(!$supplier){
            $message = "Supplier tidak ditemukan !";
            return session()->flash('fail', $message);
        }

        $barang = Barang::find($this->id_barang);
        if(!$barang){
            $message = "Barang tidak ditemukan !";
            return session()->flash('fail', $message);
        }

        // $checkSupplier Barang
        $checkSupplierBarang = SupplierBarang::where('id_supplier', $this->id_supplier)
        ->where('id_barang', $this->id_barang)->first();
        if($checkSupplierBarang){
            $message = "Barang sudah terpasang pada supplier !";
            return session()->flash('fail', $message);
        }

        SupplierBarang::create([
            'id_supplier' => $this->id_supplier,
            'id_barang' => $this->id_barang
        ]);

        $message = 'Berhasil menambahkan barang ke supplier';
        activity()->causedBy(HelperController::user())->log("Menambahkan barang ke supplier");
        $this->emit('refreshSupplierBarang');
        $this->emit('onFinishTambahBarang', 1, $message);
        return session()->flash('success', $message);
    }

    public function setIdSupplier($id_supplier){
        $this->id_supplier = $id_supplier;
    }

    public function setIdBarang($id_barang){
        $this->id_barang = $id_barang;
    }
}
