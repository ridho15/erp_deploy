<?php

namespace App\Http\Livewire\DaftarTugas;

use App\Http\Controllers\HelperController;
use App\Models\Barang;
use App\Models\LaporanPekerjaan;
use App\Models\LaporanPekerjaanBarang;
use App\Models\LaporanPekerjaanBarangLog;
use App\Models\QuotationDetail;
use App\Models\SupplierOrderDetailTemp;
use Livewire\Component;
use Livewire\WithPagination;

class LaporanPinjam extends Component
{
    use WithPagination;
    public $listeners = [
        'simpanLaporanPinjam',
        'setDataLaporanPekerjaanBarangLaporanPinjam'
    ];
    public $paginationTheme = 'bootstrap';
    public $cari;
    public $total_show = 10;
    public $id_tipe_barang = 1;

    protected $listLaporanPekerjaanBarang;
    public $id_laporan_pekerjaan;
    public $tambahBarang = false;
    public $barang;
    public $listBarang = [];
    public $listVersion = [];
    public $version;
    public $id_barang;
    public $qty;
    public $estimasi;
    public $catatan_teknisi;
    public $nomor_itt;
    public $id_laporan_pekerjaan_barang;
    public function render()
    {
        $this->barang = Barang::find($this->id_barang);
        $this->listBarang = Barang::get();
        $this->listVersion = HelperController::getListVersion();
        $this->listLaporanPekerjaanBarang = LaporanPekerjaanBarang::where(function($query){
            $query->whereHas('barang', function($query){
                $query->where('id', 'LIKE', '%' . $this->cari . '%')
                ->orWhere('nama', 'LIKE', '%' . $this->cari . '%');
            });
        })
        ->where('is_laporan_pinjam', 1)
        ->where('id_laporan_pekerjaan', $this->id_laporan_pekerjaan)
        ->paginate($this->total_show);

        $data['listLaporanPekerjaanBarang'] = $this->listLaporanPekerjaanBarang;

        $this->dispatchBrowserEvent('contentChangeLaporanPinjam');
        return view('livewire.daftar-tugas.laporan-pinjam', $data);
    }

    public function mount($id_laporan_pekerjaan){
        $this->id_laporan_pekerjaan = $id_laporan_pekerjaan;
    }

    public function changeTambahBarang(){
        $this->tambahBarang = !$this->tambahBarang;
    }

    public function simpanLaporanPinjam(){
        $this->validate([
            'id_barang' => 'required|numeric',
            'qty' => 'required|numeric',
            'catatan_teknisi' => 'nullable|string',
            'version' => 'required|numeric',
            'id_tipe_barang' => 'required|numeric',
            'estimasi' => 'required|string',
        ], [
            'id_barang.required' => 'Barang belum dipilih',
            'id_barang.numeric' => 'Data barang tidak valid !',
            'qty.required' => 'Jumlah barang tidak boleh kosong',
            'qty.numeric' => 'Jumlah barang tidak valid !',
            'catatan_teknisi.string' => 'Catatan teknisi tidak valid !',
        ]);

        $laporanPekerjaanBarang = LaporanPekerjaanBarang::where('id', $this->id_laporan_pekerjaan_barang)->first();
        // if($laporanPekerjaanBarang && $laporanPekerjaanBarang->nomor_itt != $this->nomor_itt){
        //     $checkLaporanPekerjaanBarangNomorITT = LaporanPekerjaanBarang::where('nomor_itt', $this->nomor_itt)
        //     ->whereDate('updated_at', now())->first();
        //     if($checkLaporanPekerjaanBarangNomorITT){
        //         $message = "Nomor ITT sudah digunakan. Silahkan gunakan nomor lainnya";
        //         return session()->flash('fail', $message);
        //     }
        // }

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
            'catatan_teknisi' => $this->catatan_teknisi,
            'status' => 1,
            'konfirmasi' => 0,
            'peminjam' => session()->get('id_user'),
            'version' => $this->version,
            'id_tipe_barang' => $this->id_tipe_barang,
            'estimasi' => date('Y-m-d H:i:s', strtotime($this->estimasi)),
            'is_laporan_pinjam' => 1
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
        $this->catatan_teknisi = null;
        $this->qty = null;
        $this->id_tipe_barang = null;
        $this->version = null;
        $this->estimasi = null;
    }

    public function setDataLaporanPekerjaanBarangLaporanPinjam($id_laporan_pekerjaan_barang){
        $laporanPekerjaanBarang = LaporanPekerjaanBarang::find($id_laporan_pekerjaan_barang);
        if(!$laporanPekerjaanBarang){
            $message = 'Data pinjman tidak ditemukan !';
            return session()->flash('fail', $message);
        }

        $this->id_laporan_pekerjaan_barang = $laporanPekerjaanBarang->id;
        $this->id_barang = $laporanPekerjaanBarang->id_barang;
        $this->catatan_teknisi = $laporanPekerjaanBarang->catatan_teknisi;
        $this->qty = $laporanPekerjaanBarang->qty;
        $this->id_tipe_barang = $laporanPekerjaanBarang->id_tipe_barang;
        $this->version = $laporanPekerjaanBarang->version;
        $this->estimasi = $laporanPekerjaanBarang->estimasi;
    }
}
