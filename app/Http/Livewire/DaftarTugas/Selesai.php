<?php

namespace App\Http\Livewire\DaftarTugas;

use App\Models\LaporanPekerjaan;
use Livewire\Component;
use Livewire\WithPagination;

class Selesai extends Component
{
    use WithPagination;
    public $paginationTheme = 'bootstrap';
    public $total_show = 10;
    public $cari;

    protected $listTugas;
    public function render()
    {
        $this->listTugas = LaporanPekerjaan::where('signature', '!=', null)
            ->where('jam_selesai', '!=', null)
            ->where(function ($query) {
                $query->where('id', 'LIKE', '%' . $this->cari . '%')
                    ->orWhereHas('projectUnit', function ($query) {
                        $query->whereHas('project', function ($query) {
                            $query->where('nama', 'LIKE', '%' . $this->cari . '%');
                        });
                    })->orWhereHas('teknisi', function ($query) {
                        $query->whereHas('user', function ($query) {
                            $query->where('name', 'LIKE', '%' . $this->cari . '%');
                        });
                    });
            })->orderBy('updated_at', 'DESC')->paginate($this->total_show);

        $data['listLaporanPekerjaan'] = $this->listTugas;
        return view('livewire.daftar-tugas.selesai', $data);
    }
}
