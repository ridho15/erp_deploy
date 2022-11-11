<?php

namespace App\Http\Livewire\Inventory;

use App\Models\BarangStockLog;
use Livewire\Component;
use Livewire\WithPagination;

class BarangMasuk extends Component
{
    use WithPagination;
    public $listeners = ['simpanCheck'];
    public $paginationTheme = 'bootstrap';
    public $cari;
    public $total_show = 10;
    protected $listBarangMasuk;
    public function render()
    {
        $this->listBarangMasuk = BarangStockLog::where(function($query){
            $query->where('perubahan', 'LIKE', '%' . $this->cari . '%')
            ->orWhere('tanggal_perubahan', 'LIKE', '%' . $this->cari . '%')
            ->orWhereHas('barang', function($query){
                $query->where('nama', 'LIKE', '%' . $this->cari . '%')
                ->orWhere('deskripsi', 'LIKE', '%' . $this->cari . '%');
            });
        })->where('id_tipe_perubahan_stock', 3)->orderBy('created_at', 'DESC')->paginate($this->total_show);
        $data['listBarangMasuk'] = $this->listBarangMasuk;
        return view('livewire.inventory.barang-masuk', $data);
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
