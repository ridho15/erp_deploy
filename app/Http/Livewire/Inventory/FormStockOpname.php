<?php

namespace App\Http\Livewire\Inventory;

use App\Http\Controllers\HelperController;
use App\Models\Barang;
use App\Models\StockOpname;
use Livewire\Component;

class FormStockOpname extends Component
{
    public $listeners = [
        'changeBarang',
        'simpanStockOpname'
    ];

    public $id_barang;
    public $jumlah_tercatat;
    public $jumlah_mutasi;
    public $jumlah_terjual;
    public $jumlah_terbaru;
    public $keterangan;
    public $tanggal_input;
    public $listBarang = [];

    public function render()
    {
        $this->listBarang = Barang::get();
        $this->dispatchBrowserEvent('contentChange');
        return view('livewire.inventory.form-stock-opname');
    }

    public function mount(){
        $this->tanggal_input = date('Y-m-d');
    }

    public function changeBarang($id_barang){
        $this->id_barang = $id_barang;
        $barang = Barang::find($this->id_barang);
        $this->jumlah_tercatat = $barang->stock;
    }

    public function simpanStockOpname(){
        $this->validate([
            'id_barang' => 'required|numeric',
            'jumlah_tercatat' => 'required|numeric',
            'tanggal_input' => 'required|date',
            'keterangan' => 'nullable|string',
            // 'id_merk' => 'required|numeric'
        ], [
            'id_barang.required' => 'Barang belum dipilih',
            'id_barang.numeric' => 'Barang tidak valid !',
            'jumlah_tercatat.required' => 'Jumlah tercatat tidak boleh kosong',
            'jumlah_tercatat_numeric' => 'Jumlah tercatat tidak valid !',
            'tanggal_input.required' => 'Tanggal tidak boleh kosong',
            'tanggal_input.date' => 'Tanggal tidak valid !',
            'keterangan.string' => 'Keterangan tidak valid !',
            // 'id_merk.required' => 'Merk Belum dipilih',
            // 'id_merk.numeric' => 'Merk tidak valid !'
        ]);

        $stockOpname = StockOpname::where('tanggal', $this->tanggal_input)
        ->where('id_barang', $this->id_barang)
        ->first();
        if($stockOpname){
            $message = "Barang dengan tanggal yang dipilih sudah ada. silahkan edit Stock Opname pada tabel";
            return session()->flash('fail', $message);
        }

        StockOpname::create([
            'id_barang' => $this->id_barang,
            'tanggal' => $this->tanggal_input,
            'jumlah_tercatat' => $this->jumlah_tercatat,
            'jumlah_mutasi' => $this->jumlah_mutasi,
            'jumlah_terjual' => $this->jumlah_terjual,
            'jumlah_terbaru' => $this->jumlah_terbaru,
            'keterangan' => $this->keterangan,
            'id_user' => session()->get('id_user')
        ]);

        $message = "Berhasil menyimpan data";
        activity()->causedBy(HelperController::user())->log("Menyimpan data stock opname");
        $this->resetInputFields();
        $this->emit('refreshStockOpname');
        $this->emit('finishSimpanData', 1, $message);
        return session()->flash('success', $message);
    }

    public function resetInputFields(){
        $this->id_barang = null;
        $this->tanggal_input = null;
        $this->jumlah_tercatat = null;
        $this->jumlah_mutasi = null;
        $this->jumlah_terjual = null;
        $this->jumlah_terbaru = null;
        $this->keterangan = null;
    }
}
