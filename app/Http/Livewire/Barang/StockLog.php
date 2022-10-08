<?php

namespace App\Http\Livewire\Barang;

use App\Models\Barang;
use App\Models\BarangStockLog;
use Livewire\Component;
use Livewire\WithPagination;

class StockLog extends Component
{
    use WithPagination;
    public $paginationTheme = 'bootstrap';
    public $listeners = ['simpanDataStock'];
    public $id_barang;
    protected $listStockLog;
    public $total_show = 10;
    public $stock;
    public $min_stock;
    public $barang;
    public function render()
    {
        $this->listStockLog = BarangStockLog::where('id_barang', $this->id_barang)->orderBy('tanggal_perubahan', 'DESC')->paginate($this->total_show);
        $data['listStockLog'] = $this->listStockLog;
        return view('livewire.barang.stock-log', $data);
    }

    public function mount($id_barang){
        $this->id_barang = $id_barang;
        $this->barang = Barang::find($this->id_barang);
        $this->stock = $this->barang->stock;
        $this->min_stock = $this->barang->min_stock;
    }

    public function simpanDataStock(){
        $this->validate([
            'stock' => 'required|numeric',
            'min_stock' => 'required|numeric'
        ], [
            'stock.required' => 'Stock tidak boleh kosong',
            'stock.numeric' => 'Stock tidak valid !',
            'min_stock.required' => 'Minimal stock tidak boleh kosong',
            'min_stock.numeric' => 'Minimal stock tidak valid !',
        ]);

        $barang = Barang::find($this->id_barang);
        if(!$barang){
            $message = "Barang tidak ditemukan";
            return session()->flash('fail', $message);
        }

        $data = null;
        if($barang->stock < $this->stock){
            $data['id_barang'] = $this->id_barang;
            $data['stock_awal'] = $barang->stock;
            $data['perubahan'] = $this->stock - $barang->stock;
            $data['tipe_perubahan'] = 1;
            $data['tanggal_perubahan'] = now();
        }elseif ($barang->stock > $this->stock) {
            $data['id_barang'] = $this->id_barang;
            $data['stock_awal'] = $barang->stock;
            $data['perubahan'] = $barang->stock - $this->stock;
            $data['tipe_perubahan'] = 2;
            $data['tanggal_perubahan'] = now();
        }


        if($data != null){
            $barang->update([
                'stock' => $this->stock,
                'min_stock' => $this->min_stock
            ]);
            BarangStockLog::create($data);
        }

        $message = "Berhasil mengupdate stock barang";
        $this->emit('finishUpdateStock', 1, $message);
        return session()->flash('success', $message);
    }
}
