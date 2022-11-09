<?php

namespace App\Http\Livewire\Inventory;

use App\Models\BarangStockLog;
use Livewire\Component;
use Livewire\WithPagination;

class BarangTerjual extends Component
{
    use WithPagination;
    public $listeners = ['simpanCheck'];
    public $paginationTheme = 'bootstrap';
    public $cari;
    public $total_show = 10;
    protected $listBarangTerjual;
    public function render()
    {
        $this->listBarangTerjual = BarangStockLog::where(function($query){
            $query->where('perubahan', 'LIKE', '%' . $this->cari . '%')
            ->orWhere('tanggal_perubahan', 'LIKE', '%' . $this->cari . '%')
            ->orWhereHas('barang', function($query){
                $query->where('nama', 'LIKE', '%' . $this->cari . '%')
                ->orWhere('deskripsi', 'LIKE', '%' . $this->cari . '%');
            });
        })->where('id_tipe_perubahan_stock', 4)->paginate($this->total_show);
        $data['listBarangTerjual'] = $this->listBarangTerjual;
        return view('livewire.inventory.barang-terjual', $data);
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
