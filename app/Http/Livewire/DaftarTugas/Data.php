<?php

namespace App\Http\Livewire\DaftarTugas;

use App\Models\LaporanPekerjaan;
use Livewire\Component;
use Livewire\WithPagination;

class Data extends Component
{
    use WithPagination;
    public $paginationTheme = 'bootstrap';
    public $listeners = ['simpanDaftarTugas', 'setDaftarTugas'];
    public $total_show = 10;
    public $cari;
    protected $listLaporanPekerjaan;
    public function render()
    {
        $this->listLaporanPekerjaan = LaporanPekerjaan::where(function($query){
            $query->where('nomor_lift', 'LIKE', '%' . $this->cari . '%')
            ->orWhere('keterangan', 'LIKE', '%' . $this->cari . '%')
            ->orWhereHas('customer', function($query){
                $query->where('nama', 'LIKE' , '%' . $this->cari . '%');
            })->orWhereHas('project', function($query){
                $query->where('kode', 'LIKE', '%' . $this->cari . '%')
                ->orWhere('nama', 'LIKE', '%' . $this->cari . '%');
            });
        })->whereHas('formMaster')->orderBy('created_at', 'DESC')->paginate($this->total_show);
        $data['listLaporanPekerjaan'] = $this->listLaporanPekerjaan;
        return view('livewire.daftar-tugas.data', $data);
    }

    public function mount(){

    }
}
