<?php

namespace App\Http\Livewire\ManagementTugas;

use App\Models\LaporanPekerjaan;
use Livewire\Component;
use Livewire\WithPagination;

class Data extends Component
{
    use WithPagination;
    public $paginationTheme = 'bootstrap';
    public $listeners = [
        'refreshManagementTugas' => '$refresh',
        'hapusManagementTugas',
        'setKirim',
    ];
    public $total_show = 10;
    public $cari;
    protected $listLaporanPekerjaan;

    public function render()
    {
        $this->listLaporanPekerjaan = LaporanPekerjaan::where('dikirim', 0)->where(function ($query) {
            $query->where('nomor_lift', 'LIKE', '%'.$this->cari.'%')
            ->orWhere('keterangan', 'LIKE', '%'.$this->cari.'%')
            ->orWhereHas('customer', function ($query) {
                $query->where('nama', 'LIKE', '%'.$this->cari.'%');
            })->orWhereHas('project', function ($query) {
                $query->where('nama', 'LIKE', '%'.$this->cari.'%');
            });
        })->whereHas('formMaster')->orderBy('created_at', 'DESC')->paginate($this->total_show);
        $data['listLaporanPekerjaan'] = $this->listLaporanPekerjaan;

        return view('livewire.management-tugas.data', $data);
    }

    public function mount()
    {
    }

    public function setKirim($id)
    {
        $laporanPekerjaan = LaporanPekerjaan::find($id);
        if (!$laporanPekerjaan) {
            $message = 'Data management tugas tidak ditemukan';
            $this->emit('finishRefreshData', 0, $message);

            return session()->flash('fail', $message);
        }

        $laporanPekerjaan->dikirim = 1;
        $laporanPekerjaan->save();

        $message = 'Data management tugas berhasil dikirim ke daftar tugas';
        $this->emit('finishRefreshData', 1, $message);

        return session()->flash('success', $message);
    }

    public function hapusManagementTugas($id)
    {
        $laporanPekerjaan = LaporanPekerjaan::find($id);
        if (!$laporanPekerjaan) {
            $message = 'Data management tugas tidak ditemukan';
            $this->emit('finishRefreshData', 0, $message);

            return session()->flash('fail', $message);
        }

        $laporanPekerjaan->delete();
        $message = 'Data management tugas berhasil dihapus';
        $this->emit('finishRefreshData', 1, $message);

        return session()->flash('success', $message);
    }
}
