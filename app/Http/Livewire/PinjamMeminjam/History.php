<?php

namespace App\Http\Livewire\PinjamMeminjam;

use App\Models\LaporanPekerjaanBarangLog;
use Livewire\Component;
use Livewire\WithPagination;

class History extends Component
{
    use WithPagination;
    public $paginationTheme = 'bootstrap';
    public $total_show = 10;
    public $cari;

    protected $listLaporanPekerjaanBarangLog;
    public function render()
    {
        $this->listLaporanPekerjaanBarangLog = LaporanPekerjaanBarangLog::where(function($query){
            $query->whereHas('laporanPekerjaanBarang', function($query){
                $query->whereHas('barang', function($query){
                    $query->where('nama', 'LIKE' , '%' . $this->cari . '%')
                    ->orWhere('id', 'LIKE', '%' . $this->cari . '%');
                });
            });
        })
        ->orderBy('updated_at', 'DESC')
        ->paginate($this->total_show);

        $data['listLaporanPekerjaanBarangLog'] = $this->listLaporanPekerjaanBarangLog;
        return view('livewire.pinjam-meminjam.history', $data);
    }

    public function mount(){

    }
}
