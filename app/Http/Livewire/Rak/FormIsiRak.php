<?php

namespace App\Http\Livewire\Rak;

use App\Http\Controllers\HelperController;
use App\Models\Barang;
use App\Models\IsiRak;
use App\Models\Rak;
use Livewire\Component;

class FormIsiRak extends Component
{
    public $listeners = [
        'setIdRak',
        'simpanIsiRak',
        'changeBarang',
        'setIsiRak',
        'simpanPindahRak'
    ];
    public $id_isi_rak;
    public $id_rak;
    public $id_barang;
    public $jumlah;
    public $listBarang = [];
    public $listRak = [];
    public $barang;
    public function render()
    {
        $this->listRak = Rak::get();
        $this->listBarang = Barang::get();

        $this->dispatchBrowserEvent('contentChange');
        return view('livewire.rak.form-isi-rak');
    }

    public function mount(){

    }

    public function simpanIsiRak(){
        $this->validate([
            'id_barang' => 'required|numeric',
            'id_rak' => 'required|numeric',
            'jumlah' => 'required|numeric'
        ], [
            'id_barang.required' => 'Barang tidak boleh kosong',
            'id_barang.numeric' => 'Barang tidak valid !',
            'id_rak.required' => 'Rak belum dipilih',
            'id_rak.numeric' => 'Rak tidak valid !',
            'jumlah.required' => 'Jumlah belum diisi',
            'jumlah.numeric' => 'Jumlah tidak valid !'
        ]);

        if($this->jumlah == 0){
            $message = "Jumlah tidak boleh 0";
            return session()->flash('fail', $message);
        }

        $tersediaDiRak = 0;
        foreach ($this->barang->isiRak as $item) {
            if ($item->rak && $this->id_isi_rak != $item->id) {
                $tersediaDiRak += $item->jumlah;
            }
        }

        if (($this->barang->stock - $tersediaDiRak) < $this->jumlah) {
            $message = "Jumlah yang dimasukkan melebihi jumlah barang yang tidak berada di dalam rak. silahkan check stock dan ketersediaan barang";
            return session()->flash('fail', $message);
        }

        $isiRak = IsiRak::where('id_rak', $this->id_rak)
        ->where('id_barang', $this->id_barang)
        ->first();
        if($isiRak && $this->id_isi_rak == null){
            $isiRak->update([
                'jumlah' => $isiRak->jumlah + $this->jumlah
            ]);
        }else{
            IsiRak::updateOrCreate([
                'id' => $this->id_isi_rak,
            ], [
                'id_rak' => $this->id_rak,
                'id_barang' => $this->id_barang,
                'jumlah' => $this->jumlah
            ]);
        }


        $message = "Barang berhasil di masukkan ke dalam rak";
        activity()->causedBy(HelperController::user())->log("Memasukkan barang ke dalam rak");

        $this->resetInputFields();
        $this->emit('refreshRak');
        $this->emit('finishSimpanData', 1, $message);
        return session()->flash('success', $message);
    }

    public function setIdRak($id_rak){
        $this->id_rak = $id_rak;
    }

    public function resetInputFields(){
        $this->id_isi_rak = null;
        $this->id_rak = null;
        $this->id_barang = null;
        $this->jumlah = null;
    }

    public function changeBarang($id_barang){
        $this->id_barang = $id_barang;
        $this->barang = Barang::find($this->id_barang);
    }

    public function setIsiRak($id){
        $isiRak = IsiRak::find($id);
        if(!$isiRak){
            $message = "Data isi rak tidak ditemukan !";
            return session()->flash('fail', $message);
        }

        $this->id_isi_rak = $isiRak->id;
        $this->id_rak = $isiRak->id_rak;
        $this->id_barang = $isiRak->id_barang;
        $this->jumlah = $isiRak->jumlah;

        $this->barang = Barang::find($this->id_barang);
    }

    public function simpanPindahRak(){
        $this->validate([
            'id_isi_rak' => 'required|numeric',
            'id_rak' => 'required|numeric',
            'jumlah' => 'required|numeric'
        ], [
            'id_rak.required' => "Rak belum dipilih",
            'id_rak.numeric' => 'Rak tidak valid !',
            'jumlah.required' => 'Jumlah belum diisi',
            'jumlah.numeric' => 'Jumlah tidak valid !',
            'id_isi_rak.required' => "Isi rak tidak valid !",
            'id_isi_rak.numeric' => 'Isi rak tidak valid !'
        ]);

        $isiRak = IsiRak::find($this->id_isi_rak);
        if($this->jumlah > $isiRak->jumlah){
            $message = "Jumlah yang dipindahkan tidak boleh lebih besar dari yang tersedia !";
            return session()->flash('fail', $message);
        }elseif($this->jumlah == $isiRak->jumlah){
            $isiRak->update([
                'id_rak' => $this->id_rak
            ]);
        }else{
            $isiRakTemp = IsiRak::where('id_rak', $this->id_rak)
            ->where('id_barang', $this->id_barang)->first();
            if($isiRakTemp){
                $isiRakTemp->update([
                    'jumlah' => $isiRakTemp->jumlah + $this->jumlah
                ]);
            }else{
                IsiRak::create([
                    'id_rak' => $this->id_rak,
                    'id_barang' => $this->id_barang,
                    'jumlah' => $this->jumlah
                ]);
            }

            $isiRak->update([
                'jumlah' => $isiRak->jumlah - $this->jumlah
            ]);
        }

        $message = "Berhasil memindahkan barang ke rak lain";
        activity()->causedBy(HelperController::user())->log("Melakukan pemindahan barang ke rak lain");
        $this->resetInputFields();
        $this->emit('refreshRak');
        $this->emit('finishSimpanData', 1, $message);
        return session()->flash('success', $message);
    }
}
