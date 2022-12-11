<?php

namespace App\Http\Livewire\PinjamMeminjam;

use App\Http\Controllers\HelperController;
use App\Models\Barang;
use App\Models\LaporanPekerjaan;
use App\Models\LaporanPekerjaanBarang;
use App\Models\Rak;
use App\Models\TipeBarang;
use App\Models\User;
use Dompdf\FrameReflower\NullFrameReflower;
use Livewire\Component;

class FormPermintaanBarang extends Component
{
    public $id_laporan_pekerjaan;
    public $id_barang = [];
    public $qty;
    public $peminjam;
    public $id_tipe_barang;
    public $version;
    public $estimasi;

    public $listeners = [
        'refreshFormPermintaanBarang' => '$refresh',
        'simpanPermintaanBarang'
    ];

    public $listLaporanPekerjaan;
    public $listBarang;
    public $listUser;
    public $listTipeBarang;
    public $listVersion;
    public $listRak;
    public function render()
    {
        $this->listLaporanPekerjaan = LaporanPekerjaan::where('jam_selesai', null)
        ->where('signature', null)->get();
        $this->listBarang = Barang::get();
        $this->listUser = User::get();
        $this->listTipeBarang = TipeBarang::get();
        $this->listVersion = HelperController::getListVersion();
        $this->listRak = Rak::whereHas('isiRak', function($query){
            $query->where("id_barang", $this->id_barang);
        })->get();

        $this->dispatchBrowserEvent('contentChange');
        return view('livewire.pinjam-meminjam.form-permintaan-barang');
    }

    public function simpanPermintaanBarang(){
        $this->validate([
            'id_laporan_pekerjaan' => 'required|numeric',
            'id_barang' => 'required|array',
            'qty' => 'required|numeric',
            'peminjam' => 'required|numeric',
            'id_tipe_barang' => 'required|numeric',
            'version' => 'required|numeric',
            'estimasi' => 'required|string',
        ], [
            'id_laporan_pekerjaan.required' => 'Proyek belum dipilih',
            'id_laporan_pekerjaan.numeric' => 'Proyek tidak valid !',
            'id_barang.required' => 'Barang belum dipilih',
            'id_barang.numeric' => 'Barang tidak valid !',
            'qty.required' => 'Jumlah barang tidak boleh kosong',
            'qty.numeric'=> 'Jumlah barang tidak valid !',
            'peminjam.required' => 'Peminjam belum dipilih',
            'peminjam.numeric' => 'Peminjam tidak valid !',
            'id_tipe_barang.required' => 'Tipe barang belum dipilih',
            'id-tipe_barang.numeric' => 'Tipe barang tidak valid !',
            'version.required' => 'Version tidak boleh kosong',
            'version.numeric' => 'Version tidak valid !',
            'estimasi.required' => 'Estimasi peminjaman tidak boleh kosong',
            'estimasi.string' => 'Estimasi peminjaman tidak valid !',
        ]);

        foreach ($this->id_barang as $item) {
            LaporanPekerjaanBarang::create([
                'id_laporan_pekerjaan' => $this->id_laporan_pekerjaan,
                'id_barang' => $item,
                'qty' => $this->qty,
                'peminjam' => $this->peminjam,
                'id_tipe_barang' => $this->id_tipe_barang,
                'version' => $this->version,
                'estimasi' => date('Y-m-d H:i:s', strtotime($this->estimasi)),
                'status' => 1,
            ]);
        }


        $message = "Berhasil menambah permintaan barang";
        activity()->causedBy(HelperController::user())->log("Melakukan permintaan barang secara manual");

        $this->resetInputFields();
        $this->emit('refreshBarangDiminta');
        $this->emit('finishSimpanData', 1, $message);
        return session()->flash('success', $message);
    }

    public function resetInputFields(){
        $this->id_laporan_pekerjaan = null;
        $this->id_barang = null;
        $this->qty = null;
        $this->peminjam = null;
        $this->id_tipe_barang = null;
        $this->version = null;
        $this->estimasi = null;
    }
}
