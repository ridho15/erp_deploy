<?php

namespace App\Http\Livewire\ManagementTugas;

use App\Models\LaporanPekerjaan;
use App\Models\ProjectV2;
use Carbon\Carbon;
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
        'filterData',
        'clearFilter',
        'sendAllData'
    ];
    public $total_show = 10;
    public $cari;
    public $date1;
    public $date2;
    protected $listLaporanPekerjaan;
    public $status_pekerjaan;
    public $tanggal_pekerjaan;
    public $id_project;

    public $listProject = [];

    public function render()
    {
        $date = $this->cari;

        if (preg_match('/^(0[1-9]|[1-2][0-9]|3[0-1])-(0[1-9]|1[0-2])-[0-9]{4}$/', $date)) {
            $this->cari = Carbon::parse($this->cari)->locale('id')->isoFormat('YYYY/MM/DD hh:mm:ss');
        }

        if($this->cari != null){
            $this->listLaporanPekerjaan = LaporanPekerjaan::where(function($query) {
                $query->where('nomor_lift', 'LIKE', '%'.$this->cari.'%')
                ->orWhere('keterangan', 'LIKE', '%'.$this->cari.'%')
                ->orWhere('jam_mulai', 'LIKE', '%'.$this->cari.'%')
                ->orWhere('jam_selesai', 'LIKE', '%'.$this->cari.'%')
                ->orWhere('tanggal_pekerjaan', 'LIKE', '%'.$this->cari.'%')
                ->orWhereHas('customer', function ($query) {
                    $query->where('nama', 'LIKE', '%'.$this->cari.'%');
                })->orWhereHas('project', function ($query) {
                    $query->where('nama', 'LIKE', '%'.$this->cari.'%');
                });
            })->whereHas('formMaster')->orderBy('created_at', 'DESC')->paginate($this->total_show);
        }
        elseif($this->status_pekerjaan != null || $this->tanggal_pekerjaan != null || $this->id_project != null){
            $this->listLaporanPekerjaan = LaporanPekerjaan::where(function($query) {
                $query->where('nomor_lift', 'LIKE', '%'.$this->cari.'%')
                ->orWhere('keterangan', 'LIKE', '%'.$this->cari.'%')
                ->orWhere('jam_mulai', 'LIKE', '%'.$this->cari.'%')
                ->orWhere('jam_selesai', 'LIKE', '%'.$this->cari.'%')
                ->orWhere('tanggal_pekerjaan', 'LIKE', '%'.$this->cari.'%')
                ->orWhereHas('customer', function ($query) {
                    $query->where('nama', 'LIKE', '%'.$this->cari.'%');
                })->orWhereHas('project', function ($query) {
                    $query->where('nama', 'LIKE', '%'.$this->cari.'%');
                });
            })->where(function($query){
                $query->whereDate('tanggal_pekerjaan', $this->tanggal_pekerjaan)
                ->orWhere(function($query){
                    if($this->status_pekerjaan == 0){
                        $query->where('jam_mulai', null);
                    }elseif($this->status_pekerjaan == 1){
                        $query->where('jam_mulai', '!=', null)
                        ->where('jam_selesai', null)
                        ->where('signature', null);
                    }elseif($this->status_pekerjaan == 2){
                        $query->where('jam_selesai', '!=', null)
                        ->where('signature', '!=', null);
                    }
                })->orWhere('id_project', $this->id_project);
            })
            ->whereHas('formMaster')->orderBy('created_at', 'DESC')->paginate($this->total_show);
        }else{
            $this->listLaporanPekerjaan = LaporanPekerjaan::whereHas('formMaster')->orderBy('created_at', 'DESC')->paginate($this->total_show);
        }

        $this->listProject = ProjectV2::get();

        $data['listLaporanPekerjaan'] = $this->listLaporanPekerjaan;
        $this->dispatchBrowserEvent('contentChange');
        return view('livewire.management-tugas.data', $data);
    }

    public function mount()
    {
    }

    public function filterData()
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

    public function clearFilter(){
        $this->tanggal_pekerjaan = null;
        $this->status_pekerjaan = null;
        $this->id_project = null;
    }

    public function sendAllData(){
        $managementTugas = LaporanPekerjaan::where('dikirim', 0)->get();
        foreach ($managementTugas as $item) {
            $item->update([
                'dikirim' => 1
            ]);
        }

        $message = "Berhasil mengirim data";
        return session()->flash('success', $message);
    }
}
