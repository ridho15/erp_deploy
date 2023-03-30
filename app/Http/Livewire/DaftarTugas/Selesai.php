<?php

namespace App\Http\Livewire\DaftarTugas;

use App\Http\Controllers\HelperController;
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
        $listTipeUser = json_decode(HelperController::user()->id_tipe_user);
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
            })->where(function ($query) use ($listTipeUser) {
                if (in_array(4, $listTipeUser) && !in_array(1, $listTipeUser) && !in_array(2, $listTipeUser) && !in_array(3, $listTipeUser)) {
                    $query->whereHas('teknisi', function ($query) {
                        $query->where('id_user', session()->get('id_user'));
                    });
                };
            })
            ->orderBy('updated_at', 'DESC')->paginate($this->total_show);

        $data['listLaporanPekerjaan'] = $this->listTugas;
        return view('livewire.daftar-tugas.selesai', $data);
    }
}
