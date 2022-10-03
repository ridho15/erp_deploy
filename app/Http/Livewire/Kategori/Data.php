<?php

namespace App\Http\Livewire\Kategori;

use App\Models\BarangKategori;
use App\Models\Kategori;
use Livewire\Component;
use Livewire\WithPagination;

class Data extends Component
{
    use WithPagination;
    public $paginationTheme = 'bootstrap';
    public $listeners = ['refreshDataKategori' => '$refresh', 'hapusKategori', 'lihatBarang'];
    protected $listKategori;
    public $listBarangKategori;
    public $cari;
    public $total_show = 10;
    public function render()
    {
        $this->listKategori = Kategori::where(function($query){
            $query->where('nama_kategori', 'LIKE', '%' . $this->cari . '%');
        })->paginate($this->total_show);
        $data['listKategori'] = $this->listKategori;
        return view('livewire.kategori.data', $data);
    }

    public function mount(){

    }

    public function hapusKategori($id){
        $kategori = Kategori::find($id);
        if(!$kategori){
            $message = 'Kategori tidak ditemukan';

            $this->emit('finishDataKategori', 0, $message);
        }

        $kategori->delete();
        $message = "Berhasil menghapus data";

        $this->emit('finishDataKategori', 1, $message);
        return session()->flash('success', $message);
    }

    public function lihatBarang($id_kategori){
        $this->listBarangKategori = BarangKategori::where('id_kategori', $id_kategori)->get();
    }
}
