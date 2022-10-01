<?php

namespace App\Http\Livewire\Barang;

use App\Http\Controllers\HelperController;
use App\Models\Barang;
use App\Models\BarangStockLog;
use App\Models\Merk;
use Livewire\Component;

class Form extends Component
{
    protected $helper;
    function __construct()
    {
        $this->helper = new HelperController;
    }
    public $listeners = ['setDataBarang', 'simpanDataBarang', 'changeTipeBarang'];
    public $id_barang;
    public $nama;
    public $harga;
    public $id_merk;
    public $tipe_barang;
    public $stock;
    public $min_stock;
    public $listMerk;
    public $listTipeBarang;
    public function render()
    {
        $this->listMerk = Merk::get();
        $this->listTipeBarang = $this->helper->getListTipeBarang();

        $this->dispatchBrowserEvent('contentChange');
        return view('livewire.barang.form');
    }

    public function mount(){

    }

    public function resetInputFields(){
        $this->id_barang = null;
        $this->nama = null;
        $this->harga = null;
        $this->id_merk = null;
        $this->tipe_barang = null;
        $this->stock = null;
        $this->min_stock = null;
    }

    public function simpanDataBarang(){
        $this->validate([
            'nama' => 'required|string',
            'harga' => 'required|numeric',
            'id_merk' => 'nullable|numeric',
            'tipe_barang' => 'required|numeric',
            'stock' => 'required|numeric',
            'min_stock' => 'required|numeric'
        ], [
            'nama.required' => 'Nama tidak boleh kosong',
            'nama.string' => 'Nama tidak valid !',
            'harga.required' => 'Harga tidak boleh kosong',
            'harga.numeric' => 'Harga tidak valid !',
            'id_merk.numeric' => 'Merk tidak valid !',
            'tipe_barang.required' => 'Tipe Barang belum dipilih',
            'tipe_barang.numeric' => 'Tipe Barang tidak valid !',
            'stock.required' => 'Stock barang tidak boleh kosong',
            'stock.numeric' => 'Stock Barang tidak valid !',
            'min_stock.required' => 'Minimal Stock Barang tidak boleh kosong',
            'min_stock.numeric' => 'Minimal Stock Barang tidak valid !',
        ]);

        // Check Merk
        if($this->id_merk){
            $merk = Merk::find($this->id_merk);
            if($merk){
                $data['id_merk'] = $this->id_merk;
            }
        }

        if($this->stock < 0 || $this->min_stock < 0){
            $message = "Stok atau minimal tidak boleh kurang dari 0";
            return session()->flash('fail', $message);
        }

        if($this->id_barang){
            $barang = Barang::find($this->id_barang);
            if(!$barang){
                $message = "Barang tidak ditemukan";
                $this->emit('finishDataBarang', 0, $message);
                return session()->flash('fail', $message);
            }

            if($barang->stock < $this->stock){
                $selisih = $this->stock - $barang->stock;
                $tipe_perubahan = 1;

                BarangStockLog::create([
                    'id_barang' => $this->id_barang,
                    'stock_awal' => $barang->stock,
                    'perubahan' => $selisih,
                    'tipe_perubahan' => $tipe_perubahan,
                    'tangga_perubahan' => now()
                ]);

            }elseif($barang->stock > $this->stock){
                $selisih = $barang->stock - $this->stock;
                $tipe_perubahan = 2;
                BarangStockLog::create([
                    'id_barang' => $this->id_barang,
                    'stock_awal' => $barang->stock,
                    'perubahan' => $selisih,
                    'tipe_perubahan' => $tipe_perubahan,
                    'tangga_perubahan' => now()
                ]);
            }

            $data['nama'] = $this->nama;
            $data['harga'] = $this->harga;
            $data['stock'] = $this->stock;
            $data['min_stock'] = $this->min_stock;
            $data['tipe_barang'] = $this->tipe_barang;
            $barang->update($data);

            $message = 'Berhasil mengupdate barang';
            $this->resetInputFields();
            $this->emit('refreshDataBarang');
            $this->emit('finishSimpanData', 1, $message);
            return session()->flash('success', $message);
        }else{
            $data['nama'] = $this->nama;
            $data['harga'] = $this->harga;
            $data['stock'] = $this->stock;
            $data['min_stock'] = $this->min_stock;
            $data['tipe_barang'] = $this->tipe_barang;

            Barang::create($data);
            $message = 'Berhasil menambah barang';
            $this->resetInputFields();
            $this->emit('refreshDataBarang');
            $this->emit('finishSimpanData', 1, $message);
            return session()->flash('success', $message);
        }
    }

    public function setDataBarang($id){
        $barang = Barang::find($id);
        if(!$barang){
            $message = 'Barang tidak ditemukan';
            $this->emit('finishRefreshBarang', 0, $message);
            return session()->flash('fail', $message);
        }

        $this->id_barang = $barang->id;
        $this->nama = $barang->nama;
        $this->harga = $barang->harga;
        $this->id_merk = $barang->id_merk;
        $this->tipe_barang = $barang->tipe_barang;
        $this->stock = $barang->stock;
        $this->min_stock = $barang->min_stock;
    }

    public function changeTipeBarang($tipeBarang){
        $this->tipe_barang = $tipeBarang;
    }
}
