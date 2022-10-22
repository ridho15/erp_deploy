<?php

namespace App\Http\Livewire\ManagementTugas;

use App\Models\LaporanPekerjaan;
use Carbon\Carbon;
use Livewire\Component;

class AturJadwal extends Component
{
    public $listeners = [
        'simpanDataJadwal',
        'setDataLaporanPekerjaan'
    ];
    public $id_laporan_pekerjaan;
    public $laporanPekerjaan;
    public $jam_mulai;
    public $tanggal;
    public function render()
    {
        if($this->jam_mulai){
            $this->tanggal = Carbon::parse($this->jam_mulai)->locale('id')->isoFormat('dddd, DD MMMM YYYY');
        }
        $this->dispatchBrowserEvent('contentChangeFormAturJadwal');
        return view('livewire.management-tugas.atur-jadwal');
    }

    public function mount(){

    }

    public function simpanDataJadwal(){
        $this->validate([
            'jam_mulai' => 'required|string'
        ], [
            'jam_mulai.required' => 'Jam mulai tidak boleh kosong',
            'jam_mulai.string' => 'Jam mulai tidak valid !'
        ]);

        $this->laporanPekerjaan->update([
            'jam_mulai' => date('Y-m-d H:i:s', strtotime($this->jam_mulai))
        ]);

        $message = 'Berhasil mengatur ulang jadwal';
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
    }

    public function resetInputFields(){
        $this->id_laporan_pekerjaan = null;
        $this->jam_mulai = null;
        $this->laporanPekerjaan = null;
    }
}
