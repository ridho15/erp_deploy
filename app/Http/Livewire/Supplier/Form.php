<?php

namespace App\Http\Livewire\Supplier;

use App\Http\Controllers\HelperController;
use App\Models\Sales;
use App\Models\Supplier;
use App\Models\SupplierSales;
use Livewire\Component;

class Form extends Component
{
    public $listeners = ['setDataSupplier', 'changeSales'];
    public $id_supplier;
    public $name;
    public $email;
    public $alamat;
    public $status;
    public $no_hp_1;
    public $no_hp_2;
    public $telp_1;
    public $telp_2;
    public $list_id_sales;
    public $pic;
    public $produk;

    public $listSales = [];
    public function render()
    {
        $this->dispatchBrowserEvent('contentChange');
        return view('livewire.supplier.form');
    }

    public function mount()
    {
        $this->listSales = Sales::get();
    }

    public function simpanDataSupplier()
    {
        $this->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'alamat' => 'required|string',
            'pic' => 'nullable|string',
            'produk' => 'nullable|string'
        ], [
            'name.required' => 'Nama tidak boleh kosong',
            'name.string' => 'Nama tidak valid !',
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Email tidak valid !',
            'no_hp.digits_between' => 'Nomor HP tidak sesuai ketentuan !',
            'alamat.required' => 'Alamat tidak boleh kosong',
            'alamat.string' => "Alamat tidak valid !"
        ]);

        $supplier = Supplier::updateOrCreate([
            'id' => $this->id_supplier
        ], [
            'name' => $this->name,
            'email' => $this->email,
            'alamat' => $this->alamat,
            'status' => $this->status ? 1 : 0,
            'no_hp_1' => $this->no_hp_1,
            'no_hp_2' => $this->no_hp_2,
            'telp_1' => $this->telp_1,
            'telp_2' => $this->telp_2,
            'pic' => $this->pic,
            'produk' => $this->produk,
        ]);

        SupplierSales::where('id_supplier', $supplier->id)
            ->delete();
        foreach ($this->list_id_sales as $item) {
            SupplierSales::create([
                'id_sales' => $item,
                'id_supplier' => $supplier->id,
            ]);
        }

        $message = 'Berhasil menyimpan data supplier';
        activity()->causedBy(HelperController::user())->log("Menyimpan data supplier");

        $this->resetInputFields();
        $this->emit('finishSimpanData', 1, $message);
        $this->emit('refreshDataSupplier');
        return session()->flash('success', $message);
    }

    public function resetInputFields()
    {
        $this->id_supplier = null;
        $this->name = null;
        $this->email = null;
        $this->alamat = null;
        $this->status = null;
        $this->no_hp_1 = null;
        $this->no_hp_2 = null;
        $this->telp_1 = null;
        $this->telp_2 = null;
        $this->pic = null;
        $this->produk = null;
    }

    public function setDataSupplier($id)
    {
        $supplier = Supplier::find($id);
        if (!$supplier) {
            $message = "Data Supplier tidak ditemukan";
            $this->emit('finishDataSupplier', 0, $message);
            return session()->flash('fail', $message);
        }

        $this->id_supplier = $supplier->id;
        $this->name = $supplier->name;
        $this->email = $supplier->email;
        $this->status = $supplier->status;
        $this->alamat = $supplier->alamat;
        $this->no_hp_1 = $supplier->no_hp_1;
        $this->no_hp_2 = $supplier->no_hp_2;
        $this->telp_1 = $supplier->telp_1;
        $this->telp_2 = $supplier->telp_2;
        $this->pic = $supplier->pic;
        $this->produk = $supplier->produk;

        $this->list_id_sales = [];
        foreach($supplier->supplierSales as $item){
            array_push($this->list_id_sales, $item->id_sales);
        }
    }

    public function changeSales($list_id_sales)
    {
        $this->list_id_sales = $list_id_sales;
    }
}
