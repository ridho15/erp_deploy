<?php

namespace App\Http\Livewire\Inventory;

use App\Models\BarangStockLog;
use Livewire\Component;
use Livewire\WithPagination;

class BarangDibalikan extends Component
{
    use WithPagination;
    public $listeners = ['simpanCheck'];
    public $paginationTheme = 'bootstrap';
    public $total_show = 10;
    public $cari;
    protected $listBarangDibalikan;
    public function render()
    {
        $this->listBarangDibalikan = BarangStockLog::where(function($query){
            $query->where('perubahan', 'LIKE', '%' . $this->cari . '%')
            ->orWhere('tanggal_perubahan', 'LIKE', '%' . $this->cari . '%')
            ->orWhereHas('barang', function($query){
                $query->where('nama', 'LIKE', '%' . $this->cari . '%')
                ->orWhere('deskripsi', 'LIKE', '%' . $this->cari . '%');
            });
        })->where('id_tipe_perubahan_stock', 5)->paginate($this->total_show);
        $data['listBarangDibalikan'] = $this->listBarangDibalikan;
        return view('livewire.inventory.barang-dibalikan', $data);
    }

    public function mount(){

    }

    public function simpanCheck($id){
        $barangStockLog = BarangStockLog::find($id);
        if(!$barangStockLog){
            $message = "Data tidak ditemukan";
            return session()->flash('fail', $message);
        }

        $barangStockLog->update([
            'check' => $barangStockLog->check == 1 ? 0 : 1
        ]);
    }
}
