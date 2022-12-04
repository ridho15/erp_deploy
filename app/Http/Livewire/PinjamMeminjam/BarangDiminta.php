<?php

namespace App\Http\Livewire\PinjamMeminjam;

use App\Http\Controllers\HelperController;
use App\Models\Barang;
use App\Models\BarangStockLog;
use App\Models\LaporanPekerjaanBarang;
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
    public function render()
    {
        $this->listBarangDiminta = LaporanPekerjaanBarang::where(function($query){
            $query->where('catatan_teknisi', 'LIKE', '%' . $this->cari . '%')
            ->orWhere('keterangan_customer', 'LIKE', '%' . $this->cari . '%')
            ->orWhere('qty', 'LIKE', '%' . $this->cari . '%')
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
        }

        $data['listBarangDiminta'] = $this->listBarangDiminta;
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

        $message = "Berhasil mengupdate data";
        activity()->causedBy(HelperController::user())->log("Menolak atau mengabaikan peminjaman barang");
        $this->emit('finishSimpanData', 1, $message);
        return session()->flash('success', $message);
    }

    public function confirmasiPeminjamanBarang(){
        $this->validate([
            'qty' => 'required|numeric',
            'id_laporan_pekerjaan_barang' => 'required|numeric'
        ], [
            'id_laporan_pekerjaan_barang.required' => 'Data tidak valid !',
            'id_laporan_pekerjaan_barang.numeric' => 'Data tidak valid !',
            'qty.required' => 'Jumlah barang tidak boleh kosong',
            'qty.numeric' => 'Jumlah barang tidak valid !'
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
            // $qty = $this->qty - $barang->stock;

            // $barang->barangStockChange($barang->stock, 1);

            //


            // $jumlahSisaBarangDiminta = $laporanPekerjaanBarang->qty - $barang->stock;
            // if ($jumlahSisaBarangDiminta > 0) {
            //     LaporanPekerjaanBarang::create([
            //         'id_laporan_pekerjaan' => $laporanPekerjaanBarang->id_laporan_pekerjaan,
            //         'id_barang' => $laporanPekerjaanBarang->id_barang,
            //         'catatan_teknisi' => $laporanPekerjaanBarang->catatan_teknisi,
            //         'keterangan_customer' => $laporanPekerjaanBarang->keterangan_customer,
            //         'qty' => $jumlahSisaBarangDiminta,
            //         'status' => 1,
            //         'konfirmasi' => 0
            //     ]);
            // }

            // $laporanPekerjaanBarang->update([
            //     'status' => 1,
            //     'qty' => $barang->stock,
            //     'konfirmasi' => 1
            // ]);

            // $message = "Stock kurang dari barang yang diminta. Barang yang kurang sudah masuk pada temporary supplier order";
        }else{
            if($this->qty != $laporanPekerjaanBarang->qty){
                LaporanPekerjaanBarang::create([
                    'id_laporan_pekerjaan' => $laporanPekerjaanBarang->id_laporan_pekerjaan,
                    'id_barang' => $laporanPekerjaanBarang->id_barang,
                    'catatan_teknisi' => $laporanPekerjaanBarang->catatan_teknisi,
                    'keterangan_customer' => $laporanPekerjaanBarang->keterangan_customer,
                    'qty' => $laporanPekerjaanBarang->qty - $this->qty,
                    'status' => 1,
                    'konfirmasi' => 0,
                ]);

                $laporanPekerjaanBarang->update([
                    'status' => 1,
                    'qty' => $this->qty,
                    'konfirmasi' => 1,
                    'meminjamkan' => session()->get('id_user')
                ]);
            }else{
                $laporanPekerjaanBarang->update([
                    'status' => 1,
                    'konfirmasi' => 1,
                    'meminjamkan' => session()->get('id_user')
                ]);
            }
            $message = "Berhasil mengupdate data";
        }
        activity()->causedBy(HelperController::user())->log("Mengkonfirmasi peminjaman barang");

        $this->emit('refreshBarangDipinjam');
        $this->emit('refreshStockBarang');
        $this->emit('refreshAcurateMasuk');
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
    }
}
