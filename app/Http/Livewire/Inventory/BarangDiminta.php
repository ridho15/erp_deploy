<?php

namespace App\Http\Livewire\Inventory;

use App\Models\Barang;
use App\Models\BarangStockLog;
use App\Models\LaporanPekerjaanBarang;
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
        return view('livewire.inventory.barang-diminta', $data);
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
            'konfirmasi' => 0
        ]);

        $message = "Berhasil mengupdate data";
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
        $response = $barang->barangStockChange($this->qty, 1);
        if($response['status'] == 0){
            return session()->flash('fail', $response['message']);
        }

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
                'konfirmasi' => 1
            ]);
        }else{
            $laporanPekerjaanBarang->update([
                'status' => 1,
                'konfirmasi' => 1
            ]);
        }

        $message = "Berhasil mengupdate data";
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
