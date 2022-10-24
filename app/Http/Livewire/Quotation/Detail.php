<?php

namespace App\Http\Livewire\Quotation;

use App\Models\Barang;
use App\Models\Quotation;
use App\Models\QuotationDetail;
use Livewire\Component;

class Detail extends Component
{
    public $listeners = [
        'hapusDataBarang',
        'simpanDataBarang',
        'setDataBarang',
        'changeTambahBarang',
        'changeQty'
    ];
    public $id_quotation;
    public $quotation;
    public $id_quotation_detail;
    public $id_barang;
    public $qty;
    public $tambahBarang = false;
    public $barang;
    public $cari;
    public $listBarang = [];
    public function render()
    {
        $this->barang = Barang::find($this->id_barang);
        $this->quotation = Quotation::find($this->id_quotation);
        $this->listBarang = Barang::get();
        $this->dispatchBrowserEvent('contentChange');
        return view('livewire.quotation.detail');
    }

    public function mount($id_quotation){
        $this->id_quotation = $id_quotation;
    }

    public function hapusDataBarang($id){
        $quotationDetail = QuotationDetail::find($id);
        if(!$quotationDetail){
            $message = "Data tidak ditemukan !";
            $this->emit('finishRefreshBarang', 0, $message);
            return session()->flash('fail', $message);
        }

        $quotationDetail->delete();
        $message = "Berhasil menghapus data";
        $this->emit('finishRefreshBarang', 1, $message);
        return session()->flash('success', $message);
    }

    public function simpanDataBarang(){
        $this->validate([
            'id_barang' => 'required|numeric',
            'qty' => 'required|numeric',
        ], [
            'id_barang.required' => 'Barang belum dipilih',
            'id_barang.numeric' => 'Barang tidak valid !',
            'qty.required' => 'Jumlah tidak boleh kosong',
            'qty.numeric' => 'Jumlah tidak valid !',
        ]);

        $barang = Barang::find($this->id_barang);
        if(!$barang){
            $message = "Data barang tidak ditemukan !";
            $this->emit('finishRefreshBarang', 0, $message);
            return session()->flash('fail', $message);
        }

        if($this->qty <= 0){
            $message = "Jumlah 0 tidak berlaku. minimal 1";
            $this->emit('finishRefreshBarang', 0, $message);
            return session()->flash('fail', $message);
        }

        // checkstock yang sudah digunakan
        $quotationDetail = QuotationDetail::where('id_barang', $this->id_barang)
        ->where('id_quotation', $this->id_quotation)->get();
        $stockTerpakai = 0;
        foreach ($quotationDetail as $item) {
            $stockTerpakai += $item->qty;
        }
        $stockTerpakai += $this->qty;

        if($this->id_quotation_detail != null){
            $quotationDetail = QuotationDetail::find($this->id_quotation_detail);
            if($this->qty != $quotationDetail->qty){
                if($this->qty > ($barang->stock + $quotationDetail->qty)){
                    $message = "Stock tidak mencukupi. silahkan hubungi warehouse";
                    return session()->flash('fail', $message);
                }
            }
        }else{
            if($stockTerpakai > $barang->stock){
                $message = "Stock tidak cukup";
                $this->emit('finishRefreshBarang', 0, $message);
                return session()->flash('fail', $message);
            }
        }


        QuotationDetail::updateOrCreate([
            'id' => $this->id_quotation_detail
        ], [
            'id_quotation' => $this->id_quotation,
            'id_barang' => $this->id_barang,
            'harga' => $barang->harga,
            'qty' => $this->qty,
            'id_satuan' => $barang->id_satuan,
            'deskripsi' => $barang->deskripsi
        ]);

        $message = "Berhasil menyimpan data";
        $this->tambahBarang = false;
        $this->resetInputFields();
        $this->emit('finishRefreshBarang', 1, $message);
        return session()->flash('success', $message);
    }

    public function resetInputFields(){
        $this->id_quotation_detail = null;
        $this->id_barang = null;
        $this->qty = null;
    }

    public function setDataBarang($id){
        $this->tambahBarang = true;
        $quotationDetail = QuotationDetail::find($id);
        if(!$quotationDetail){
            $message = "Data quotation barang tidak ditemukan !";
            $this->emit('finishRefreshBarang', 0, $message);
            return session()->flash('fail', $message);
        }

        $this->id_quotation_detail = $quotationDetail->id;
        $this->id_barang = $quotationDetail->id_barang;
        $this->qty = $quotationDetail->qty;
    }

    public function changeTambahBarang(){
        $this->tambahBarang = !$this->tambahBarang;
    }

    public function changeQty(){
        if($this->qty && $this->id_barang){
            $this->barang = Barang::find($this->id_barang);
            if($this->qty > $this->barang->stock){
                $message = "Stock tidak cukup";
                return session()->flash('fail', $message);
            }
        }
    }
}
