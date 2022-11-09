<?php

namespace App\Http\Livewire\Inventory;

use App\Models\Barang;
use App\Models\BarangStockLog;
use App\Models\LaporanPekerjaan;
use App\Models\LaporanPekerjaanBarang;
use Livewire\Component;
use Livewire\WithPagination;

class BarangDipinjam extends Component
{
    use WithPagination;
    public $listeners = [
        'refreshBarangDipinjam' => '$refresh',
        'balikanBarangPinjaman',
        'simpanDataPeminjamanBarang',
        'setBarangPinjaman',
        'simpanCheck'
    ];
    public $paginationTheme = 'bootstrap';
    public $cari;
    public $total_show = 10;
    protected $listBarangDipinjam = [];
    public $qty;
    public $id_laporan_pekerjaan_barang;
    public $laporanPekerjaanBarang;
    public $barang;
    public $listLaporanPekerjaan = [];
    public $id_laporan_pekerjaan;
    public $laporanPekerjaan;
    public $listBarang = [];
    public $id_barang;
    public $subTotal = 0;
    public $catatan_teknisi;
    public $keterangan_customer;
    public function render()
    {
        $this->listBarangDipinjam = LaporanPekerjaanBarang::where(function($query){
            $query->where('catatan_teknisi', 'LIKE', '%' . $this->cari . '%')
            ->orWhere('keterangan_customer', 'LIKE', '%' . $this->cari . '%')
            ->orWhere('qty', 'LIKE', '%' . $this->cari . '%')
            ->orWhereHas('barang', function($query){
                $query->where('nama', 'LIKE', '%' . $this->cari . '%');
            });
        })->where('status', 2)->orderBy('updated_at', 'DESC')
        ->paginate($this->total_show);

        $this->listLaporanPekerjaan = LaporanPekerjaan::where('jam_selesai', null)
        ->orWhere('signature', null)
        ->get();

        $this->listBarang = Barang::get();

        if ($this->id_laporan_pekerjaan) {
            $this->laporanPekerjaan = LaporanPekerjaan::find($this->id_laporan_pekerjaan);
        }

        if($this->id_barang){
            $this->barang = Barang::find($this->id_barang);
        }

        if($this->qty && $this->barang){
            $this->subTotal = $this->qty * $this->barang->harga;
        }

        $this->dispatchBrowserEvent('contentChange');
        $data['listBarangDipinjam'] = $this->listBarangDipinjam;
        return view('livewire.inventory.barang-dipinjam', $data);
    }

    public function mount(){

    }

    public function balikanBarangPinjaman(){
        $laporanPekerjaanBarang = LaporanPekerjaanBarang::find($this->id_laporan_pekerjaan_barang);
        if(!$laporanPekerjaanBarang){
            $message = "Data tidak ditemukan !";
            $this->emit('finishSimpanData', 0, $message);
            return session()->flash('fail', $message);
        }

        if($this->qty > $laporanPekerjaanBarang->qty){
            $message = "Jumlah barang di kembalikan lebih besar dari yang dipinjam. mohon di check ulang jumlah barang";
            return session()->flash('fail', $message);
        }

        $barang = Barang::find($laporanPekerjaanBarang->id_barang);
        $response = $barang->barangStockChange($this->qty, 5);
        if($response['status'] == 0){
            return session()->flash('fail', $response['message']);
        }

        if($this->qty != $laporanPekerjaanBarang->qty){
            LaporanPekerjaanBarang::create([
                'id_laporan_pekerjaan' => $this->id_laporan_pekerjaan,
                'id_barang' => $this->id_barang,
                'qty' => $laporanPekerjaanBarang->qty - $this->qty,
                'status' => 2
            ]);
        }

        $laporanPekerjaanBarang->update([
            'qty' => $this->qty,
            'status' => 3
        ]);

        $message = 'Berhasil mengembalikan barang ke gudang';
        $this->emit('refreshBarangDiminta');
        $this->emit('refreshStockBarang');
        $this->emit('finishSimpanData', 1, $message);
        return session()->flash('success', $message);
    }

    public function simpanDataPeminjamanBarang(){
        $this->validate([
            'id_laporan_pekerjaan' => 'required|numeric',
            'id_barang' => 'required|numeric',
            'qty' => 'required|numeric'
        ], [
            'id_laporan_pekerjaan.required' => 'Data laporan pekerjaan tidak valid !',
            'id_laporan_pekerjaan.numeric' => 'Data laporan pekerjaan tidak valid !',
            'id_barang.required' => 'Data barang belum dipilih !',
            'id_barang.numeric' => 'Data barang tidak valid !',
            'qty.required' => 'Jumlah barang tidak boleh kosong !',
            'qty.numeric' => 'Jumlah barang tidak valid !',
        ]);

        // Check Data Barang
        $barang = Barang::find($this->id_barang);
        if(!$barang){
            $message = "Data barang tidak ditemukan !";
            return session()->flash('fail', $message);
        }

        if($this->qty <= 0){
            $message = "Jumlah barang yang dipinjam tidak boleh 0 atau kurang dari 0";
            return session()->flash('fail', $message);
        }

        if($this->qty > $barang->stock){
            $message = "Barang yang dipinjam melebihi stock yang tersedia. silahkan pesan barang kepada supplier / vendor";
            return session()->flash('fail', $message);
        }

        $response = $barang->barangStockChange($this->qty, 1);
        if($response['status'] == 0){
            return session()->flash('fail', $response['message']);
        }

        LaporanPekerjaanBarang::updateOrCreate([
            'id' => $this->id_laporan_pekerjaan_barang
        ], [
            'id_laporan_pekerjaan' => $this->id_laporan_pekerjaan,
            'id_barang' => $this->id_barang,
            'qty' => $this->qty,
            'status' => 2
        ]);


        $message = 'Berhasil memasukkan barang ke laporan pekerjaan';
        $this->emit('refreshBarangDiminta');
        $this->emit('refreshStockBarang');
        $this->emit('finishSimpanData', 1, $message);
        return session()->flash('success', $message);
    }

    public function setBarangPinjaman($id_laporan_pekerjaan_barang){
        $laporanPekerjaanBarang = LaporanPekerjaanBarang::find($id_laporan_pekerjaan_barang);
        if(!$laporanPekerjaanBarang){
            $message = "Data Barang tidak ditemukan !";
            return session()->flash('fail', $message);
        }

        $this->id_laporan_pekerjaan_barang = $laporanPekerjaanBarang->id;
        $this->id_laporan_pekerjaan = $laporanPekerjaanBarang->id_laporan_pekerjaan;
        $this->id_barang = $laporanPekerjaanBarang->id_barang;
        $this->catatan_teknisi = $laporanPekerjaanBarang->catatan_teknisi;
        $this->keterangan_customer = $laporanPekerjaanBarang->keterangan_customer;
        $this->qty = $laporanPekerjaanBarang->qty;
    }

    public function simpanCheck($id){
        $barangStockLog = BarangStockLog::find($id);
        if(!$barangStockLog){
            $message = "Data tidak ditemukan";
            return session()->flash('fail', $message);
        }

        $barangStockLog->update([
            'check' => $barangStockLog->check == 1 ? 0 : 1
        ]);
    }
}
