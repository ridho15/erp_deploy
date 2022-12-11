<?php

namespace App\Http\Livewire\DaftarTugas;

use App\Http\Controllers\HelperController;
use App\Models\Barang;
use App\Models\LaporanPekerjaan;
use App\Models\LaporanPekerjaanBarang;
use App\Models\LaporanPekerjaanBarangLog;
use App\Models\NomorPeminjamanHarian;
use App\Models\QuotationDetail;
use App\Models\SupplierOrderDetailTemp;
use App\Models\TipeBarang;
use Livewire\Component;

class LaporanSparepart extends Component
{
    public $listeners = [
        'refreshLaporanPekerjaanBarang' => '$refresh',
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
    public $version;
    public $id_tipe_barang;
    public $estimasi;
    public $nomor_itt;

    public $listTipeBarang;
    public $listVersion;
    public function render()
    {
        $this->listTipeBarang = TipeBarang::get();
        $this->listVersion = HelperController::getListVersion();
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
        $this->version = $laporanPekerjaanBarang->version;
        $this->id_tipe_barang = $laporanPekerjaanBarang->id_tipe_barang;
        $this->nomor_itt = $laporanPekerjaanBarang->nomor_itt;
        if ($laporanPekerjaanBarang->estimasi) {
            $this->estimasi = date('Y-m-d H:i', strtotime($laporanPekerjaanBarang->estimasi));
        }
    }

    public function hapusLaporanPekerjaanBarang($id){
        $laporanPekerjaanBarang = LaporanPekerjaanBarang::find($id);
        if($laporanPekerjaanBarang->laporanPekerjaan->quotation){
            $quotation = $laporanPekerjaanBarang->laporanPekerjaan->quotation;
            $quotationDetail = QuotationDetail::where('id_quotation', $quotation->id)
            ->where('qty', $laporanPekerjaanBarang->qty)
            ->where('id_barang', $laporanPekerjaanBarang->id_barang)
            ->first();
            if($quotationDetail){
                $quotationDetail->delete();
            }
        }
        if(!$laporanPekerjaanBarang){
            $message = "Data laporan barang tidak ditemukan !";
            return session()->flash('fail', $message);
        }

        $laporanPekerjaanBarang->delete();
        $message = "Data laporan barang berhasil dihapus";
        activity()->causedBy(HelperController::user())->log("Barang berhasil di hapus dari laporan");

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
            'version' => 'required|numeric',
            'id_tipe_barang' => 'required|numeric',
            'estimasi' => 'required|string',
            'nomor_itt' => 'required|numeric'
        ], [
            'id_barang.required' => 'Barang belum dipilih',
            'id_barang.numeric' => 'Data barang tidak valid !',
            'qty.required' => 'Jumlah barang tidak boleh kosong',
            'qty.numeric' => 'Jumlah barang tidak valid !',
            'catatan_teknisi.string' => 'Catatan teknisi tidak valid !',
            'keterangan_customer' => 'Keterangan customer tidak valid !',
            'nomor_itt.required' => 'Nomor ITT tidak boleh kosong',
            'nomor_itt.numeric' => 'Nomor ITT tidak valid !'
        ]);

        // Check Nomor ITT
        $nomorPeminjamanHarian = NomorPeminjamanHarian::where('itt_start', '<=', $this->nomor_itt)
        ->where('itt_end', '>=', $this->nomor_itt)
        ->whereDate('tanggal', now())->get();

        if(!$nomorPeminjamanHarian){
            $message = "Nomor ITT tidak valid !";
            return session()->flash('fail', $message);
        }

        $laporanPekerjaanBarang = LaporanPekerjaanBarang::where('id', $this->id_laporan_pekerjaan_barang)->first();
        if($laporanPekerjaanBarang && $laporanPekerjaanBarang->nomor_itt != $this->nomor_itt){
            $checkLaporanPekerjaanBarangNomorITT = LaporanPekerjaanBarang::where('nomor_itt', $this->nomor_itt)
            ->whereDate('updated_at', now())->first();
            if($checkLaporanPekerjaanBarangNomorITT){
                $message = "Nomor ITT sudah digunakan. Silahkan gunakan nomor lainnya";
                return session()->flash('fail', $message);
            }
        }

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
        foreach ($laporanPekerjaanBarang as $value) {
            $stockDiminta += $value->qty;
        }

        if($this->id_laporan_pekerjaan_barang){
            $stockDiminta = $this->qty;
        }else{
            $stockDiminta += $this->qty;
        }

        if($stockDiminta > $barang->stock){
            $jumlah_kurang = $stockDiminta - $barang->stock;
            $stock_sekarang = $barang->stock;
            $jumlah_diminta = $stockDiminta;
            SupplierOrderDetailTemp::create([
                'id_barang' => $barang->id,
                'jumlah_diminta' => $jumlah_diminta,
                'jumlah_kurang' => $jumlah_kurang,
                'stock_sekarang' => $stock_sekarang,
                'harga_satuan' => $barang->harga,
                'status' => 0,
                'keterangan' => null,
            ]);
            $message = "Jumlah yang diminta lebih besar dari stock, silahkan hubungi warehouse";
            return session()->flash('fail', $message);
        }

        $laporanPekerjaanBarang = LaporanPekerjaanBarang::updateOrCreate([
            'id' => $this->id_laporan_pekerjaan_barang
        ], [
            'id_laporan_pekerjaan' => $this->id_laporan_pekerjaan,
            'id_barang' => $this->id_barang,
            'qty' => $this->qty,
            'keterangan_customer' => $this->keterangan_customer,
            'catatan_teknisi' => $this->catatan_teknisi,
            'status' => 1,
            'konfirmasi' => 0,
            'peminjam' => session()->get('id_user'),
            'version' => $this->version,
            'id_tipe_barang' => $this->id_tipe_barang,
            'estimasi' => date('Y-m-d H:i:s', strtotime($this->estimasi)),
            'nomor_itt' => $this->nomor_itt
        ]);

        LaporanPekerjaanBarangLog::create([
            'id_laporan_pekerjaan_barang' => $laporanPekerjaanBarang->id,
            'status' => 1
        ]);

        $laporanPekerjaan = LaporanPekerjaan::find($this->id_laporan_pekerjaan);
        if($laporanPekerjaan->quotation){
            QuotationDetail::create([
                'id_quotation' => $laporanPekerjaan->quotation->id,
                'id_barang' => $this->id_barang,
                'harga' => $barang->harga,
                'qty' => $this->qty,
                'id_satuan' => $barang->id_satuan,
                'deskripsi' => $barang->deskripsi
            ]);
        }

        $message = "Laporan Data barang berhasil di simpan";
        activity()->causedBy(HelperController::user())->log("Melakukan peminjaman barang untuk laporan penggunaan barang");
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
        $this->id_tipe_barang = null;
        $this->version = null;
        $this->estimasi = null;
    }
}
