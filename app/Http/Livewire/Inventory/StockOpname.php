<?php

namespace App\Http\Livewire\Inventory;

use App\Models\Barang;
use App\Models\StockOpname as ModelsStockOpname;
use Livewire\Component;
use Livewire\WithPagination;

class StockOpname extends Component
{
    use WithPagination;
    public $paginationTheme = 'bootstrap';
    public $total_show = 10;
    public $cari;
    public $listeners = [
        'refreshStockOpname' => '$refresh',
        'simpanJumlahMutasi',
        'simpanJumlahTerjual',
        'simpanJumlahTerbaru',
        'simpanKeterangan',
        'simpanTanggal',
        'hapusStockOpname'
    ];

    public $tanggal;
    protected $listStockOpname;

    public function render()
    {
        $this->listStockOpname = ModelsStockOpname::where('tanggal', $this->tanggal)
        ->where(function($query){
            $query->whereHas('barang', function($query){
                $query->where('nama', 'LIKE', '%' . $this->cari . '%');
            });
        })->paginate($this->total_show);

        $data['listStockOpname'] = $this->listStockOpname;

        $this->dispatchBrowserEvent('contentChange');
        return view('livewire.inventory.stock-opname', $data);
    }

    public function mount(){
        $this->tanggal = date('Y-m-d');
    }

    public function simpanJumlahMutasi($id_stock_opname, $jumlah_mutasi){
        $stockOpname = ModelsStockOpname::find($id_stock_opname);
        if($stockOpname){
            $stockOpname->update([
                'jumlah_mutasi' => $jumlah_mutasi
            ]);
        }
    }

    public function simpanJumlahTerjual($id_stock_opname, $jumlah_terjual){
        $stockOpname = ModelsStockOpname::find($id_stock_opname);
        if($stockOpname){
            $stockOpname->update([
                'jumlah_terjual' => $jumlah_terjual
            ]);
        }
    }

    public function simpanJumlahTerbaru($id_stock_opname, $jumlah_terbaru){
        $stockOpname = ModelsStockOpname::find($id_stock_opname);
        if($stockOpname){
            $stockOpname->update([
                'jumlah_terbaru' => $jumlah_terbaru
            ]);
        }
    }

    public function simpanTanggal($id_stock_opname, $tanggal){
        $stockOpname = ModelsStockOpname::find($id_stock_opname);
        if($stockOpname){
            $stockOpname->update([
                'tanggal' => $tanggal
            ]);
        }
    }

    public function simpanKeterangan($id_stock_opname, $keterangan){
        $stockOpname = ModelsStockOpname::find($id_stock_opname);
        if($stockOpname){
            $stockOpname->update([
                'keterangan' => $keterangan
            ]);
        }
    }

    public function hapusStockOpname($id){
        $stockOpname = ModelsStockOpname::find($id);
        if(!$stockOpname){
            $message = "Data stock opname tidak ditemukan";
            return session()->flash('fail', $message);
        }

        $stockOpname->delete();
        $message = "Berhasil menghapus data";
        return session()->flash('success', $message);
    }
}
