<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\LaporanPekerjaan;
use Livewire\Component;

class PekerjaanHariIni extends Component
{
    public $listPekerjaanHariIni;
    public $totalPekerjaanHariIni;
    public function render()
    {
        $this->listPekerjaanHariIni = LaporanPekerjaan::whereDate('tanggal_pekerjaan', now())
        ->where('jam_selesai', null)
        ->where('signature', null)
        ->take(5)
        ->get();

        $this->totalPekerjaanHariIni = LaporanPekerjaan::whereDate('tanggal_pekerjaan', now())
        ->where('jam_selesai', null)
        ->where('signature', null)
        ->count();
        return view('livewire.dashboard.pekerjaan-hari-ini');
    }
}
