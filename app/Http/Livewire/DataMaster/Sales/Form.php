<?php

namespace App\Http\Livewire\DataMaster\Sales;

use App\Models\Sales;
use Livewire\Component;

class Form extends Component
{
    public $listeners = [
        'setSales',
        'simpanSales'
    ];

    public $id_sales;
    public $nama;
    public $no_hp;
    public $alamat;
    public $nama_perusahaan;
    public function render()
    {
        return view('livewire.data-master.sales.form');
    }

    public function setSales($id){
        $sales = Sales::find($id);
        if(!$sales){
            $message = "Data sales tidak ditemukan";
            return session()->flash('fail', $message);
        }

        $this->id_sales = $sales->id;
        $this->nama = $sales->nama;
        $this->no_hp = $sales->no_hp;
        $this->alamat = $sales->alamat;
        $this->nama_perusahaan = $sales->nama_perusahaan;
    }

    public function simpanSales(){
        $this->validate([
            'nama' => 'required|string',
            'no_hp' => 'required|numeric',
            'alamat' => 'nullable|string',
            'nama_perusahaan' => 'nullable|string'
        ]);

        Sales::updateOrCreate([
            'id' => $this->id_sales
        ], [
            'nama' => $this->nama,
            'no_hp' => $this->no_hp,
            'alamat' => $this->alamat,
            'nama_perusahaan' => $this->nama_perusahaan
        ]);

        $message = "Berhasil menyimpan data sales";
        $this->resetInputFields();
        $this->emit('refreshSales');
        $this->emit('finishSimpanData', 1, $message);
        return session()->flash('success', $message);
    }

    public function resetInputFields(){
        $this->id_sales = null;
        $this->nama = null;
        $this->no_hp = null;
        $this->alamat = null;
        $this->nama_perusahaan = null;
    }
}
