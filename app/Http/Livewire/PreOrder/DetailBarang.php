<?php

namespace App\Http\Livewire\PreOrder;

use App\Models\Barang;
use App\Models\PreOrderDetail;
use Livewire\Component;

class DetailBarang extends Component
{
    public $listeners = [
        'refreshPreOrderDetail' => '$refresh',
        'changeTambahBarang',
        'simpanBarang',
        'hapusBarang',
        'setBarang',
        'changeKeterangan'
    ];
    public $id_pre_order;
    public $id_barang;
    public $qty;
    public $keterangan;
    public $barang;
    public $cari;
    public $tambahBarang = false;
    public $id_pre_order_detail;
    public $listPreOrderDetail = [];
    public $listBarang = [];
    public function render()
    {
        $this->listBarang = Barang::get();
        $this->listPreOrderDetail = PreOrderDetail::where(function($query){
            $query->whereHas('barang', function($query){
                $query->where('nama', 'LIKE', '%' . $this->cari . '%');
            });
        })->where('id_pre_order', $this->id_pre_order)->get();

        if($this->id_barang){
            $this->barang = Barang::find($this->id_barang);
        }
        $this->dispatchBrowserEvent('contentChange');
        return view('livewire.pre-order.detail-barang');
    }

    public function mount($id_pre_order){
        $this->id_pre_order = $id_pre_order;
    }

    public function changeTambahBarang(){
        $this->tambahBarang = !$this->tambahBarang;
    }

    public function simpanBarang(){
        $this->validate([
            'id_barang' => 'required|numeric',
            'qty' => 'required|numeric',
            'keterangan' => 'nullable|string',
        ], [
            'id_barang.required' => 'Barang belum dipilih',
            'id_barang.numeric' => 'Barang tidak valid !',
            'qty.required' => 'Jumlah tidak boleh kosong',
            'qty.numeric' => 'Jumlah tidak valid !',
            'keterangan.string' => 'Keterangan tidak valid !'
        ]);

        // Check Data Barang
        $barang = Barang::find($this->id_barang);
        if(!$barang){
            $message = "Data barang tidak ditemukan / tidak valid !";
            return session()->flash('fail', $message);
        }

        if($this->qty > $barang->stock){
            $message = "Stock tidak mencukupi";
            $this->emit('finishRefreshData', 0, $message);
            return session()->flash('fail', $message);
        }

        PreOrderDetail::updateOrCreate([
            'id' => $this->id_pre_order_detail,
        ],[
            'id_pre_order' => $this->id_pre_order,
            'id_barang' => $this->id_barang,
            'harga' => $barang->harga,
            'qty' => $this->qty,
            'id_satuan' => $barang->id_satuan,
            'keterangan' => $this->keterangan
        ]);

        $message = "Data barang berhasil disimpan";
        $this->tambahBarang = false;
        $this->resetInputFields();
        $this->emit('finishSimpanData', 1, $message);
        return session()->flash('success', $message);
    }

    public function resetInputFields(){
        $this->id_pre_order_detail = null;
        $this->id_barang = null;
        $this->barang = null;
        $this->qty = null;
        $this->keterangan = null;
    }

    public function changeKeterangan($keterangan){
        $this->keterangan = $keterangan;
    }

    public function setBarang($id){
        $this->tambahBarang = true;
        $preOrderDetail = PreOrderDetail::find($id);
        if(!$preOrderDetail){
            $message = "Data tidak ditemukan";
            $this->emit('finishRefreshData', 0, $message);
            return session()->flash('fail', $message);
        }

        $this->id_pre_order_detail = $preOrderDetail->id;
        $this->id_barang = $preOrderDetail->id_barang;
        $this->qty = $preOrderDetail->qty;
        $this->keterangan = $preOrderDetail->keterangan;
    }

    public function hapusBarang($id){
        $preOrderDetail = PreOrderDetail::find($id);
        if(!$preOrderDetail){
            $message = "Data Order barang tidak ditemukan !";
            $this->emit('finishRefreshData', 0, $message);
            return session()->flash('fail', $message);
        }

        $preOrderDetail->delete();
        $message = "Berhasil menghapus data order barang";
        $this->emit('finishRefreshData', 1, $message);
        return session()->flash('success', $message);
    }
}
