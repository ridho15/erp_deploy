<?php

namespace App\Http\Livewire\Barang;

use App\Http\Controllers\HelperController;
use App\Models\Barang;
use Livewire\Component;
use Livewire\WithPagination;

class Data extends Component
{
    use WithPagination;
    public $paginationTheme = 'bootstrap';
    public $listeners = ['refreshDataBarang' => '$refresh','hapusBarang'];
    protected $listBarang;
    public $total_show;
    public $cari;
    public function render()
    {
        $this->listBarang = Barang::where(function($query){
            $query->where('nama', 'LIKE' , '%' . $this->cari . '%')
            ->orWhere('harga', 'LIKE', '%' . $this->cari . '%')
            ->orWhere('stock', 'LIKE' ,'%' . $this->cari . '%')
            ->orWhere('min_stock', 'LIKE' ,'%' . $this->cari . '%');
        })->paginate($this->total_show);
        $data['listBarang'] = $this->listBarang;
        return view('livewire.barang.data', $data);
    }

    public function mount(){

    }

    public function hapusBarang($id){
        $barang = Barang::find($id);
        if(!$barang){
            $message = "Barang tidak ditemukan";
            $this->emit('finishDataBarang', 0, $message);
            return session()->flash('fail', $message);
        }

        $barang->delete();
        $message = "Barang berhasil dihapus";
        $this->emit('finisDataBarang', 1, $message);
        return session()->flash('success', $message);
    }
}
