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
    public $no_hp;
    public $alamat;
    public $status;
    public $list_id_sales;

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
            'no_hp' => 'required|numeric|digits_between:11,12',
            'alamat' => 'required|string',
        ], [
            'name.required' => 'Nama tidak boleh kosong',
            'name.string' => 'Nama tidak valid !',
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Email tidak valid !',
            'no_hp.required' => 'Nomor Hp harus diisi',
            'no_hp.numeric' => 'Nomor Hp tidak valid !',
            'no_hp.digits_between' => 'Nomor HP tidak sesuai ketentuan !',
            'alamat.required' => 'Alamat tidak boleh kosong',
            'alamat.string' => "Alamat tidak valid !"
        ]);

        $supplier = Supplier::updateOrCreate([
            'id' => $this->id_supplier
        ], [
            'name' => $this->name,
            'email' => $this->email,
            'no_hp' => $this->no_hp,
            'alamat' => $this->alamat,
            'status' => $this->status ? 1 : 0
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
        $this->no_hp = null;
        $this->alamat = null;
        $this->status = null;
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
        $this->no_hp = $supplier->no_hp;
        $this->email = $supplier->email;
        $this->status = $supplier->status;
        $this->alamat = $supplier->alamat;

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
