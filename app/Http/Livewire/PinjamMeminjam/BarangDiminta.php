<?php

namespace App\Http\Livewire\PinjamMeminjam;

use App\Http\Controllers\HelperController;
use App\Models\Barang;
use App\Models\BarangStockLog;
use App\Models\IsiRak;
use App\Models\LaporanPekerjaanBarang;
use App\Models\LaporanPekerjaanBarangLog;
use App\Models\Rak;
use App\Models\SupplierOrderDetailTemp;
use Livewire\Component;
use Livewire\WithPagination;

class BarangDiminta extends Component
{
    use WithPagination;
    public $listeners = [
        'refreshBarangDiminta' => '$refresh',
        'abaikanPeminjamanBarang',
        'confirmasiPeminjamanBarang',
        'setLaporanPekerjaanBarang'
    ];
    public $paginationTheme = 'bootstrap';
    public $cari;
    public $total_show = 10;
    protected $listBarangDiminta;
    public $qty;
    public $id_laporan_pekerjaan_barang;
    public $laporanPekerjaanBarang;
    public $barang;
    public $listRak = [];
    public $id_barang;
    public $id_rak;
    public $estimasi;
    public function render()
    {

        $this->listBarangDiminta = LaporanPekerjaanBarang::where(function($query){
            $query->where('catatan_teknisi', 'LIKE', '%' . $this->cari . '%')
            ->orWhere('keterangan_customer', 'LIKE', '%' . $this->cari . '%')
            ->orWhere('qty', 'LIKE', '%' . $this->cari . '%')
            ->orWHere('id_laporan_pekerjaan', 'LIKE', '%' . $this->cari . '%')
            ->orWhereHas('barang', function($query){
                $query->where('nama', 'LIKE', '%' . $this->cari . '%');
            });
        })->where(function($query){
            $query->where('status', 1)
            ->orWhere('status', 0);
        })->where('konfirmasi', 0)->orderBy('updated_at', 'DESC')
        ->paginate($this->total_show);

        if ($this->laporanPekerjaanBarang) {
            $this->barang = $this->laporanPekerjaanBarang->barang;
            $this->listRak = Rak::whereHas('isiRak', function($query){
                $query->where('id_barang', $this->laporanPekerjaanBarang->id_barang);
            })->get();
        }

        $data['listBarangDiminta'] = $this->listBarangDiminta;
        $this->dispatchBrowserEvent('contentChange');
        return view('livewire.pinjam-meminjam.barang-diminta', $data);
    }

    public function mount(){

    }

    public function abaikanPeminjamanBarang($id){
        $laporanPekerjaanBarang = LaporanPekerjaanBarang::find($id);
        if(!$laporanPekerjaanBarang){
            $message = "Data tidak ditemukan !";
            $this->emit('finishSimpanData', 0, $message);
            return session()->flash('fail', $message);
        }

        $laporanPekerjaanBarang->update([
            'status' => 0,
            'konfirmasi' => 0,
            'meminjamkan' => session()->get('id_user')
        ]);

        LaporanPekerjaanBarangLog::create([
            'id_laporan_pekerjaan_barang' => $laporanPekerjaanBarang->id,
            'status' => 0
        ]);

        $message = "Berhasil mengupdate data";
        activity()->causedBy(HelperController::user())->log("Menolak atau mengabaikan peminjaman barang");
        $this->emit('finishSimpanData', 1, $message);
        return session()->flash('success', $message);
    }

    public function confirmasiPeminjamanBarang(){
        $this->validate([
            'qty' => 'required|numeric',
            'id_laporan_pekerjaan_barang' => 'required|numeric',
            'id_rak' => 'required|numeric',
            'estimasi' => 'required|string'
        ], [
            'id_laporan_pekerjaan_barang.required' => 'Data tidak valid !',
            'id_laporan_pekerjaan_barang.numeric' => 'Data tidak valid !',
            'qty.required' => 'Jumlah barang tidak boleh kosong',
            'qty.numeric' => 'Jumlah barang tidak valid !',
            'id_rak.required' => 'Rak belum dipilih',
            'id_rak.numeric' => 'Rak tidak valid !',
            'estimasi' => 'Estimasi Peminjaman belum diisi',
            'estimasi.string' => 'Estimasi peminjaman tidak valid !'
        ]);

        $laporanPekerjaanBarang = LaporanPekerjaanBarang::find($this->id_laporan_pekerjaan_barang);
        if(!$laporanPekerjaanBarang){
            $message = "Data tidak ditemukan !";
            return session()->flash('fail', $message);
        }

        if($this->qty > $laporanPekerjaanBarang->qty){
            $message = "Jumlah barang yang diberikan lebih besar dari jumlah yang diminta. harap kurangi";
            return session()->flash('fail', $message);
        }

        if($this->qty <= 0){
            $message = "Jumlah barang tidak boleh 0 atau kurang dari 0!";
            return session()->flash('fail', $message);
        }

        $rak = Rak::find($this->id_rak);
        $jumlahTersediaDalamRak = IsiRak::where('id_rak', $this->id_rak)->where('id_barang', $laporanPekerjaanBarang->id_barang)
        ->sum('jumlah');
        if($jumlahTersediaDalamRak < $this->qty){
            $message = "Jumlah barang pada Rak " . $rak->kode_rak . ' tidak mencukupi. silahkan isi rak terlebih dahulu';
            return session()->flash('fail', $message);
        }

        $barang = Barang::find($laporanPekerjaanBarang->id_barang);
        if($laporanPekerjaanBarang->laporanPekerjaan->quotation){
            $id_quotation = $laporanPekerjaanBarang->laporanPekerjaan->quotation->id;
        }else{
            $id_quotation = null;
        }
        $response = $barang->barangStockChange($this->qty, 1, $id_quotation);
        if($response['status'] == 0){
            $jumlah_kurang = $this->qty - $barang->stock;
            $stock_sekarang = $barang->stock;
            $jumlah_diminta = $this->qty;
            SupplierOrderDetailTemp::create([
                'id_barang' => $barang->id,
                'jumlah_diminta' => $jumlah_diminta,
                'jumlah_kurang' => $jumlah_kurang,
                'stock_sekarang' => $stock_sekarang,
                'harga_satuan' => $barang->harga,
                'status' => 0,
                'keterangan' => null
            ]);

            $this->emit('finishSimpanData', 0, $response['message']);
            return session()->flash('fail', $response['message']);
        }else{
            if($this->qty != $laporanPekerjaanBarang->qty){
                $laporanPekerjaanBarangNew = LaporanPekerjaanBarang::create([
                    'id_laporan_pekerjaan' => $laporanPekerjaanBarang->id_laporan_pekerjaan,
                    'id_barang' => $laporanPekerjaanBarang->id_barang,
                    'catatan_teknisi' => $laporanPekerjaanBarang->catatan_teknisi,
                    'keterangan_customer' => $laporanPekerjaanBarang->keterangan_customer,
                    'qty' => $laporanPekerjaanBarang->qty - $this->qty,
                    'status' => 1,
                    'konfirmasi' => 0,
                    'estimasi' => date('Y-m-d H:i:s', strtotime($this->estimasi))
                ]);

                LaporanPekerjaanBarangLog::create([
                    'id_laporan_pekerjaan_barang' => $laporanPekerjaanBarangNew->id,
                    'status' => 1
                ]);

                $laporanPekerjaanBarang->update([
                    'qty' => $this->qty,
                    'konfirmasi' => 1,
                    'meminjamkan' => session()->get('id_user'),
                    'estimasi' => date('Y-m-d H:i:s', strtotime($this->estimasi))
                ]);

                LaporanPekerjaanBarangLog::create([
                    'id_laporan_pekerjaan_barang' => $laporanPekerjaanBarang->id,
                    'status' => 1,
                    'keterangan' => 'Dikonfirmasi'
                ]);
            }else{
                $laporanPekerjaanBarang->update([
                    'konfirmasi' => 1,
                    'meminjamkan' => session()->get('id_user'),
                    'estimasi' => date('Y-m-d H:i:s', strtotime($this->estimasi))
                ]);

                LaporanPekerjaanBarangLog::create([
                    'id_laporan_pekerjaan_barang' => $laporanPekerjaanBarang->id,
                    'status' => 1,
                    'keterangan' => 'Dikonfirmasi'
                ]);
            }
            $message = "Berhasil mengupdate data";
        }

        $laporanPekerjaanBarang->update([
            'id_rak' => $this->id_rak,
            'estimasi' => date('Y-m-d H:i:s', strtotime($this->estimasi))
        ]);

        activity()->causedBy(HelperController::user())->log("Mengkonfirmasi peminjaman barang");

        $this->emit('refreshBarangDipinjam');
        $this->emit('refreshStockBarang');
        $this->emit('refreshAcurateKeluar');
        $this->emit('finishSimpanData', 1, $message);
        return session()->flash('success', $message);
    }

    public function resetInputFields(){
        $this->id_laporan_pekerjaan_barang = null;
        $this->qty = null;
        $this->laporanPekerjaanBarang = null;
        $this->barang = null;
    }

    public function setLaporanPekerjaanBarang($id){
        $laporanPekerjaanBarang = LaporanPekerjaanBarang::find($id);
        if(!$laporanPekerjaanBarang){
            $message = "Data Peminjaman barang tidak ditemukan !";
            return session()->flash('fail', $message);
        }

        $this->id_laporan_pekerjaan_barang = $laporanPekerjaanBarang->id;
        $this->qty = $laporanPekerjaanBarang->qty;
        $this->laporanPekerjaanBarang = $laporanPekerjaanBarang;
        $this->id_barang = $laporanPekerjaanBarang->id_barang;
        if ($laporanPekerjaanBarang->estimasi) {
            $this->estimasi = date('Y-m-d H:i', strtotime($laporanPekerjaanBarang->estimasi));
        }
    }
}
