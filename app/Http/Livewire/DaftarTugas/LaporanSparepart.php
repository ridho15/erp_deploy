<?php

namespace App\Http\Livewire\DaftarTugas;

use App\Models\Barang;
use App\Models\LaporanPekerjaanBarang;
use Livewire\Component;

class LaporanSparepart extends Component
{
    public $listeners = [
        'simpanLaporanPekerjaanBarang',
        'hapusLaporanPekerjaanBarang',
        'setDataLaporanPekerjaanBarang',
        'changeTambahBarang'
    ];
    public $listLaporanPekerjaanBarang = [];
    public $id_laporan_pekerjaan_barang;
    public $id_laporan_pekerjaan;
    public $id_barang;
    public $catatan_teknisi;
    public $keterangan_customer;
    public $qty;
    public $cari;
    public $tambahBarang = false;
    public $listBarang = [];
    public $barang;
    public function render()
    {
        $this->listBarang = Barang::get();
        $this->listLaporanPekerjaanBarang = LaporanPekerjaanBarang::where(function($query){
            $query->whereHas('barang', function($query){
                $query->where('nama', 'LIKE', '%' . $this->cari . '%');
            });
        })->where('id_laporan_pekerjaan', $this->id_laporan_pekerjaan)->get();
        if($this->id_barang){
            $this->barang = Barang::find($this->id_barang);
        }
        $this->dispatchBrowserEvent('contentChange');
        return view('livewire.daftar-tugas.laporan-sparepart');
    }

    public function mount($id_laporan_pekerjaan){
        $this->id_laporan_pekerjaan = $id_laporan_pekerjaan;
    }

    public function setDataLaporanPekerjaanBarang($id){
        $laporanPekerjaanBarang = LaporanPekerjaanBarang::find($id);
        if(!$laporanPekerjaanBarang){
            $message = "Data laporan barang tidak ditemukan !";
            return session()->flash('fail', $message);
        }

        $this->id_laporan_pekerjaan_barang = $laporanPekerjaanBarang->id;
        $this->id_barang = $laporanPekerjaanBarang->id_barang;
        $this->id_laporan_pekerjaan = $laporanPekerjaanBarang->id_laporan_pekerjaan;
        $this->catatan_teknisi = $laporanPekerjaanBarang->catatan_teknisi;
        $this->keterangan_customer = $laporanPekerjaanBarang->keterangan_customer;
        $this->qty = $laporanPekerjaanBarang->qty;
    }

    public function hapusLaporanPekerjaanBarang($id){
        $laporanPekerjaanBarang = LaporanPekerjaanBarang::find($id);
        if(!$laporanPekerjaanBarang){
            $message = "Data laporan barang tidak ditemukan !";
            return session()->flash('fail', $message);
        }

        $laporanPekerjaanBarang->delete();
        $message = "Data laporan barang berhasil dihapus";

        $this->emit('finishSimpanData', 1, $message);
        return session()->flash('success', $message);
    }

    public function changeTambahBarang(){
        $this->tambahBarang = !$this->tambahBarang;
    }

    public function simpanLaporanPekerjaanBarang(){
        $this->validate([
            'id_barang' => 'required|numeric',
            'qty' => 'required|numeric',
            'catatan_teknisi' => 'nullable|string',
            'keterangan_customer' => 'nullable|string',
        ], [
            'id_barang.required' => 'Barang belum dipilih',
            'id_barang.numeric' => 'Data barang tidak valid !',
            'qty.required' => 'Jumlah barang tidak boleh kosong',
            'qty.numeric' => 'Jumlah barang tidak valid !',
            'catatan_teknisi.string' => 'Catatan teknisi tidak valid !',
            'keterangan_customer' => 'Keterangan customer tidak valid !'
        ]);

        // Check data barang
        $barang = Barang::find($this->id_barang);
        if(!$barang){
            $message = "Data barang tidak ditemukan !";
            return session()->flash('fail', $message);
        }

        if($this->qty <= 0){
            $message = "Jumlah barang tidak boleh 0 atau lebih rendah dari 0";
            return session()->flash('fail', $message);
        }

        $laporanPekerjaanBarang = LaporanPekerjaanBarang::where('id_barang', $this->id_barang)
        ->where('id_laporan_pekerjaan', $this->id_laporan_pekerjaan)->get();
        $stockDiminta = 0;
        foreach ($laporanPekerjaanBarang as $key => $value) {
            $stockDiminta += $value->qty;
        }

        if($this->id_laporan_pekerjaan_barang){
            $stockDiminta = $this->qty;
        }else{
            $stockDiminta += $this->qty;
        }

        if($stockDiminta > $barang->stock){
            $message = "Jumlah yang diminta lebih besar dari stock, silahkan hubungi warehouse";
            return session()->flash('fail', $message);
        }

        LaporanPekerjaanBarang::updateOrCreate([
            'id' => $this->id_laporan_pekerjaan_barang
        ], [
            'id_laporan_pekerjaan' => $this->id_laporan_pekerjaan,
            'id_barang' => $this->id_barang,
            'qty' => $this->qty,
            'keterangan_customer' => $this->keterangan_customer,
            'catatan_teknisi' => $this->catatan_teknisi,
            'status' => 1
        ]);

        $message = "Laporan Data barang berhasil di simpan";
        $this->tambahBarang = false;
        $this->resetInputFields();
        $this->emit('finisSimpanData', 1, $message);
        return session()->flash('success', $message);
    }

    public function resetInputFields(){
        $this->id_laporan_pekerjaan_barang = null;
        $this->id_barang = null;
        $this->keterangan_customer = null;
        $this->catatan_teknisi = null;
        $this->qty = null;
    }
}
