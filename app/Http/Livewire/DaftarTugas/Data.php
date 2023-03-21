<?php

namespace App\Http\Livewire\DaftarTugas;

use App\Http\Controllers\HelperController;
use App\Models\LaporanPekerjaan;
use App\Models\ProjectV2;
use Livewire\Component;
use Livewire\WithPagination;

class Data extends Component
{
    use WithPagination;
    public $paginationTheme = 'bootstrap';
    public $listeners = [
        'simpanDaftarTugas',
        'setDaftarTugas',
        'setKirim',
        'clearFilter',
        'setLaporanPekerjaan'
    ];
    public $total_show = 10;
    public $cari;
    protected $listLaporanPekerjaan;
    public $listProject = [];

    public $tanggal_pekerjaan;
    public $id_project;
    public $status_pekerjaan;
    public $laporanPekerjaan;

    public function render()
    {
        if ($this->cari != null) {
            $this->listLaporanPekerjaan = LaporanPekerjaan::where(function ($query) {
                $query->where('nomor_lift', 'LIKE', '%' . $this->cari . '%')
                    ->orWhere('keterangan', 'LIKE', '%' . $this->cari . '%')
                    ->orWhereHas('projectUnit', function ($query) {
                        $query->whereHas('project', function ($query) {
                            $query->where('nama', 'LIKE', '%' . $this->cari . '%')
                                ->orWhereHas('customer', function ($query) {
                                    $query->where('nama', 'LIKE', '%' . $this->cari . '%');
                                });
                        });
                    });
            })->where('dikirim', 1)
                ->whereHas('formMaster')
                ->where('signature', null)
                ->where('jam_selesai', null)
                ->orderBy('created_at', 'DESC')
                ->paginate($this->total_show);
        } elseif ($this->tanggal_pekerjaan != null || $this->id_project != null || $this->status_pekerjaan != null) {
            $this->listLaporanPekerjaan = LaporanPekerjaan::where(function ($query) {
                $query->where('nomor_lift', 'LIKE', '%' . $this->cari . '%')
                    ->orWhere('keterangan', 'LIKE', '%' . $this->cari . '%')
                    ->orWhereHas('projectUnit', function ($query) {
                        $query->whereHas('project', function ($query) {
                            $query->where('nama', 'LIKE', '%' . $this->cari . '%')
                                ->orWhereHas('customer', function ($query) {
                                    $query->where('nama', 'LIKE', '%' . $this->cari . '%');
                                });
                        });
                    });
            })->where(function ($query) {
                $query->whereDate('tanggal_pekerjaan', $this->tanggal_pekerjaan)
                    ->orWhere(function ($query) {
                        if ($this->status_pekerjaan == 0) {
                            $query->where('jam_mulai', null);
                        } elseif ($this->status_pekerjaan == 1) {
                            $query->where('jam_mulai', '!=', null);
                        } elseif ($this->status_pekerjaan == 2) {
                            $query->where('jam_selesai', '!=', null)
                                ->where('signature', '!=', null);
                        }
                    })->orWhereHas('projectUnit', function($query){
                        $query->where('id_project', $this->id_project);
                    });
            })->where('dikirim', 1)
                ->whereHas('formMaster')
                ->orderBy('created_at', 'DESC')
                ->where('signature', null)
                ->where('jam_selesai', null)
                ->paginate($this->total_show);
        } else {
            $this->listLaporanPekerjaan = LaporanPekerjaan::where('dikirim', 1)
                ->where('signature', null)
                ->where('jam_selesai', null)
                ->whereHas('formMaster')->orderBy('created_at', 'DESC')->paginate($this->total_show);
        }

        $data['listLaporanPekerjaan'] = $this->listLaporanPekerjaan;

        $this->dispatchBrowserEvent('contentChange');
        return view('livewire.daftar-tugas.data', $data);
    }

    public function mount(){
        $this->listProject = ProjectV2::get();
    }

    public function setKirim($id)
    {
        $laporanPekerjaan = LaporanPekerjaan::find($id);
        if (!$laporanPekerjaan) {
            $message = 'Data daftar tugas tidak ditemukan';
            $this->emit('finishRefreshData', 0, $message);

            return session()->flash('fail', $message);
        }

        $laporanPekerjaan->dikirim = 0;
        $laporanPekerjaan->save();

        $message = 'Data daftar tugas berhasil dikembalikan ke management tugas';
        activity()->causedBy(HelperController::user())->log("Menghapus data tipe barang");
        $this->emit('finishRefreshData', 1, $message);

        return session()->flash('success', $message);
    }

    public function clearFilter()
    {
        $this->id_project = null;
        $this->status_pekerjaan = null;
        $this->tanggal_pekerjaan = null;
    }

    public function setLaporanPekerjaan($id)
    {
        $this->laporanPekerjaan = LaporanPekerjaan::find($id);
        $this->laporanPekerjaan->update([
            'is_check_detail' => 1
        ]);
    }
}
