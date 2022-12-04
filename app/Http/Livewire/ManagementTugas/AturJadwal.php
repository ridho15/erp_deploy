<?php

namespace App\Http\Livewire\ManagementTugas;

use App\Http\Controllers\HelperController;
use App\Models\LaporanPekerjaan;
use App\Models\LaporanPekerjaanUser;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;

class AturJadwal extends Component
{
    public $listeners = [
        'simpanDataJadwal',
        'setDataLaporanPekerjaan',
        'editPekerja'
    ];
    public $id_laporan_pekerjaan;
    public $laporanPekerjaan;
    public $jam_mulai;
    public $tanggal;

    public $edit_pekerja = false;
    public $listPekerja = [];
    public $listIdUser = [];
    public function render()
    {
        $this->listPekerja = User::get();
        if($this->jam_mulai){
            $this->tanggal = Carbon::parse($this->jam_mulai)->locale('id')->isoFormat('dddd, DD MMMM YYYY');
        }
        $this->dispatchBrowserEvent('contentChangeFormAturJadwal');
        return view('livewire.management-tugas.atur-jadwal');
    }

    public function mount(){

    }

    public function editPekerja(){
        $this->edit_pekerja = !$this->edit_pekerja;
    }

    public function simpanDataJadwal(){
        $this->validate([
            'jam_mulai' => 'required|string'
        ], [
            'jam_mulai.required' => 'Jam mulai tidak boleh kosong',
            'jam_mulai.string' => 'Jam mulai tidak valid !'
        ]);

        $this->laporanPekerjaan->update([
            'jam_mulai' => date('Y-m-d H:i:s', strtotime($this->jam_mulai)),
            'dikirim' => 0
        ]);

        LaporanPekerjaanUser::where('id_laporan_pekerjaan', $this->laporanPekerjaan->id)->delete();
        foreach ($this->listIdUser as $item) {
            LaporanPekerjaanUser::create([
                'id_laporan_pekerjaan' => $this->laporanPekerjaan->id,
                'id_user' => $item
            ]);
        }

        $message = 'Berhasil mengatur ulang jadwal';
        activity()->causedBy(HelperController::user())->log("Melakukan pengaturan ulang jadwal");
        $this->emit('refreshManagementTugas');
        $this->emit('finishSimpanData', 1, $message);
        return session()->flash('success', $message);
    }

    public function setDataLaporanPekerjaan($id){
        $laporanPekerjaan = LaporanPekerjaan::find($id);
        if(!$laporanPekerjaan){
            $message = "Data pekerjaan tidak ditemukan";
            return session()->flash('fail', $message);
        }

        $this->id_laporan_pekerjaan - $laporanPekerjaan->id;
        $this->jam_mulai = $laporanPekerjaan->jam_mulai;
        $this->laporanPekerjaan = $laporanPekerjaan;
        $this->listIdUser = [];
        foreach ($laporanPekerjaan->teknisi as $item) {
            array_push($this->listIdUser, $item->id_user);
        }
    }

    public function resetInputFields(){
        $this->id_laporan_pekerjaan = null;
        $this->jam_mulai = null;
        $this->laporanPekerjaan = null;
    }
}
