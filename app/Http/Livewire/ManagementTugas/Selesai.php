<?php

namespace App\Http\Livewire\ManagementTugas;

use App\Http\Controllers\ManagementTugasController;
use App\Models\LaporanPekerjaan;
use Livewire\Component;
use Livewire\WithPagination;

class Selesai extends Component
{
    use WithPagination;
    public $paginationTheme = 'bootstrap';
    public $total_show = 10;
    public $cari;

    protected $listManagementTugas;
    public function render()
    {
        $this->listManagementTugas = LaporanPekerjaan::where('signature', '!=', null)
            ->where('jam_selesai', '!=', null)
            ->where(function ($query) {
                $query->where('id', 'LIKE', '%' . $this->cari . '%')
                    ->orWhereHas('projectUnit', function ($query) {
                        $query->where('nama_unit', 'LIKE', '%' . $this->cari . '%')
                        ->orWhere('no_unit', 'LIKE', '%' . $this->cari . '%');
                    })->orWhereHas('teknisi', function ($query) {
                        $query->whereHas('user', function ($query) {
                            $query->where('name', 'LIKE', '%' . $this->cari . '%');
                        });
                    });
            })->paginate($this->total_show);

            $data['listLaporanPekerjaan'] = $this->listManagementTugas;
        return view('livewire.management-tugas.selesai', $data);
    }
}
