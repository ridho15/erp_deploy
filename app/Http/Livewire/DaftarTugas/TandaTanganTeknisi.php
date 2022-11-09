<?php

namespace App\Http\Livewire\DaftarTugas;

use App\Models\LaporanPekerjaanUser;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Illuminate\Support\Str;

class TandaTanganTeknisi extends Component
{
    public $listeners = [
        'clearTandaTangan',
        'simpanTandaTangan'
    ];
    public $id_laporan_pekerjaan;
    public $listLaporanPekerjaanUser;
    public $listTandaTangan = [];
    public function render()
    {
        $this->listLaporanPekerjaanUser = LaporanPekerjaanUser::where('id_laporan_pekerjaan', $this->id_laporan_pekerjaan)->get();
        $this->dispatchBrowserEvent('contentChange');
        return view('livewire.daftar-tugas.tanda-tangan-teknisi');
    }

    public function mount($id_laporan_pekerjaan){
        $this->id_laporan_pekerjaan = $id_laporan_pekerjaan;
    }

    public function clearTandaTangan($id){
        $laporanPekerjaanUser = LaporanPekerjaanUser::find($id);
        if(!$laporanPekerjaanUser){
            $message = "Data tidak ditemukan";
            return session()->flash('fail', $message);
        }

        $laporanPekerjaanUser->update([
            'signature' => null
        ]);

        $message = "Berhasil menghapus tanda tangan";
        return session()->flash('success', $message);
    }

    public function simpanTandaTangan($id, $tandaTangan){
        $laporanPekerjaanUser = LaporanPekerjaanUser::find($id);
        if(!$laporanPekerjaanUser){
            $message = "Data laporan pekerjaan tidak ditemukan";
            return session()->flash('fail', $message);
        }

        $tandaTangan = $this->base64ToImage($tandaTangan);

        $laporanPekerjaanUser->update([
            'signature' => $tandaTangan
        ]);
    }

    public function base64ToImage($data){
        $image = $data;  // your base64 encoded
        $image = str_replace('data:image/png;base64,', '', $image);
        $image = str_replace(' ', '+', $image);
        $imageName = Str::random(10).'.'.'png';
        Storage::disk('public')->put('tanda_tangan/'.$imageName, base64_decode($image));
        $signature = '/tanda_tangan/' . $imageName;
        return $signature;
        // \File::put(storage_path(). '/' . $imageName, base64_decode($image));
    }
}
