<?php

namespace App\Http\Livewire\PinjamMeminjam;

use App\Http\Controllers\HelperController;
use App\Models\NomorPeminjamanHarian;
use Livewire\Component;
use Livewire\WithPagination;

class NomorItt extends Component
{
    use WithPagination;
    public $paginationTheme = 'bootstrap';
    public $total_show = 10;
    public $listeners = [
        'simpanNomorPeminjamanHarian',
        'changeShowFormITT',
        'editNomorITT',
        'hapusNomorITT'
    ];
    public $showForm = false;
    public $id_nomor_peminjaman_harian;
    public $itt_start;
    public $itt_end;
    public $tanggal;
    public $cari;

    public $listNomorPeminjamanHarian;
    public function render()
    {
        $this->listNomorPeminjamanHarian = NomorPeminjamanHarian::where(function($query){
            $query->where('itt_start', 'LIKE', '%' . $this->cari . '%')
            ->orWhere('itt_end', 'LIKE', '%' . $this->cari . '%')
            ->orWhere('tanggal', 'LIKE', '%' . $this->cari . '%');
        })
        ->orderBy('tanggal', 'DESC')->get();
        return view('livewire.pinjam-meminjam.nomor-itt');
    }

    public function simpanNomorPeminjamanHarian(){
        $this->validate([
            'itt_start' => 'required|numeric',
            'itt_end' => 'required|numeric',
            'tanggal' => 'required|string'
        ]);

        if($this->id_nomor_peminjaman_harian != null){
            $nomorPeminjamanHarian = NomorPeminjamanHarian::find($this->id_nomor_peminjaman_harian);
            if($nomorPeminjamanHarian && $nomorPeminjamanHarian->tanggal != $this->tanggal){
                $checkNomorPeminjamanHarian = NomorPeminjamanHarian::whereDate('tanggal',$this->tanggal)->first();
                if($checkNomorPeminjamanHarian){
                    $message = "Tanggal yang dipilih sudah memiliki nomor ITT";
                    return session()->flash('fail', $message);
                }
            }
        }else{
            $nomorPeminjamanHarian = NomorPeminjamanHarian::whereDate('tanggal', $this->tanggal)->first();
            if($nomorPeminjamanHarian){
                $message = "Tanggal yang dipilih sudah memiliki nomor ITT";
                return session()->flash('fail', $message);
            }
        }

        NomorPeminjamanHarian::updateOrCreate([
            'id' => $this->id_nomor_peminjaman_harian
        ], [
            'itt_start' => $this->itt_start,
            'itt_end' => $this->itt_end,
            'tanggal' => $this->tanggal
        ]);

        $message = "Berhasil membuat nomor peminjaman baru";
        activity()->causedBy(HelperController::user())->log("Membuat / mengupdate nomor peminjaman baru");
        $this->resetInputFields();
        return session()->flash('success', $message);
    }

    public function resetInputFields(){
        $this->id_nomor_peminjaman_harian = null;
        $this->itt_start = null;
        $this->itt_end = null;
        $this->tanggal = null;
        $this->showForm = false;
    }

    public function changeShowFormITT(){
        $this->showForm = !$this->showForm;
    }

    public function editNomorITT($id){
        $nomorPeminjamanHarian = NomorPeminjamanHarian::find($id);
        if(!$nomorPeminjamanHarian){
            $message = "Data Nomor ITT tidak ditemukan";
            return session()->flash('fail', $message);
        }

        $this->id_nomor_peminjaman_harian = $nomorPeminjamanHarian->id;
        $this->itt_start = $nomorPeminjamanHarian->itt_start;
        $this->itt_end = $nomorPeminjamanHarian->itt_end;
        $this->tanggal = $nomorPeminjamanHarian->tanggal;
        $this->showForm = true;
    }

    public function hapusNomorITT($id){
        $nomorPeminjamanHarian = NomorPeminjamanHarian::find($id);
        if(!$nomorPeminjamanHarian){
            $message = "Data Nomor ITT tidak ditemukan";
            return session()->flash('fail', $message);
        }

        $nomorPeminjamanHarian->delete();
        activity()->causedBy(HelperController::user())->log("Menghapus Nomor ITT Pada Data");
        $message = "Berhasil menghapus data Nomor ITT";
        return session()->flash('success', $message);
    }
}
