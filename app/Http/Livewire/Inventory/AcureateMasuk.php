<?php

namespace App\Http\Livewire\Inventory;

use App\Models\Barang;
use App\Models\LaporanPekerjaanBarang;
use Livewire\Component;
use Livewire\WithPagination;

class AcureateMasuk extends Component
{
    use WithPagination;
    public $listeners = [
        'refreshAcurateMasuk' => '$refresh',
        'simpanCheck'
    ];
    public $paginationTheme = 'bootstrap';
    public $total_show = 10;
    public $cari;

    protected $listAcurateMasuk;
    public function render()
    {
        $this->listAcurateMasuk = LaporanPekerjaanBarang::where(function($query){
            $query->where('catatan_teknisi', 'LIKE', '%' . $this->cari . '%')
            ->orWhere('keterangan_customer', 'LIKE', '%' . $this->cari . '%')
            ->orWhere('qty', 'LIKE', '%' . $this->cari . '%')
            ->orWhereHas('barang', function($query){
                $query->where('nama', 'LIKE', '%' . $this->cari . '%');
            });
        })->where('status', 1)->where('konfirmasi', 1)->orderBy('updated_at', 'DESC')
        ->paginate($this->total_show);

        $data['listAcurateMasuk'] = $this->listAcurateMasuk;
        return view('livewire.inventory.acureate-masuk', $data);
    }

    public function simpanCheck($id){
        $laporanPekerjaanBarang = LaporanPekerjaanBarang::find($id);
        if(!$laporanPekerjaanBarang){
            $message = "Data laporan pekerjaan barang tidak ditemukan";
            return session()->flash('fail', $message);
        }

        $barang = Barang::find($laporanPekerjaanBarang->id_barang);
        $response = $barang->barangStockChange($laporanPekerjaanBarang->qty, 5);
        if($response['status'] == 0){
            return session()->flash('fail', $response['message']);
        }

        $laporanPekerjaanBarang->update([
            'status' => 2,
            'konfirmasi' => 0
        ]);

        $message = "Berhasil mengkonfirmasi data";
        $this->emit('refreshBarangDipinjam');
        return session()->flash('success', $message);
    }
}
