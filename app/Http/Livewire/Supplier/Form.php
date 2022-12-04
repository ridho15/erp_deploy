<?php

namespace App\Http\Livewire\Supplier;

use App\Http\Controllers\HelperController;
use App\Models\Supplier;
use Livewire\Component;

class Form extends Component
{
    public $listeners = ['setDataSupplier'];
    public $id_supplier;
    public $name;
    public $email;
    public $no_hp;
    public $alamat;
    public $status;
    public function render()
    {
        return view('livewire.supplier.form');
    }

    public function mount(){

    }

    public function simpanDataSupplier(){
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

        Supplier::updateOrCreate([
            'id' => $this->id_supplier
        ], [
            'name' => $this->name,
            'email' => $this->email,
            'no_hp' => $this->no_hp,
            'alamat' => $this->alamat,
            'status' => $this->status ? 1 : 0
        ]);

        $message = 'Berhasil menyimpan data supplier';
        activity()->causedBy(HelperController::user())->log("Menyimpan data supplier");

        $this->resetInputFields();
        $this->emit('finishSimpanData', 1, $message);
        $this->emit('refreshDataSupplier');
        return session()->flash('success', $message);
    }

    public function resetInputFields(){
        $this->id_supplier = null;
        $this->name = null;
        $this->email = null;
        $this->no_hp = null;
        $this->alamat = null;
        $this->status = null;
    }

    public function setDataSupplier($id){
        $supplier = Supplier::find($id);
        if(!$supplier){
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
    }
}
