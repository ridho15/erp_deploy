<?php

namespace App\Http\Livewire\Inventory;

use App\Models\Barang;
use App\Models\LaporanPekerjaanBarang;
use Livewire\Component;
use Livewire\WithPagination;

class BarangDipinjam extends Component
{
    use WithPagination;
    public $listeners = [
        'refreshBarangDipinjam' => '$refresh',
        'balikanBarangPinjaman'
    ];
    public $paginationTheme = 'bootstrap';
    public $cari;
    public $total_show = 10;
    protected $listBarangDipinjam = [];
    public $qty;
    public $id_laporan_pekerjaan_barang;
    public $laporanPekerjaanBarang;
    public $barang;
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

        $data['listBarangDipinjam'] = $this->listBarangDipinjam;
        return view('livewire.inventory.barang-dipinjam', $data);
    }

    public function mount(){

    }

    public function balikanBarangPinjaman($id){
        $laporanPekerjaanBarang = LaporanPekerjaanBarang::find($id);
        if(!$laporanPekerjaanBarang){
            $message = "Data tidak ditemukan !";
            $this->emit('finishSimpanData', 0, $message);
            return session()->flash('fail', $message);
        }

        $barang = Barang::find($laporanPekerjaanBarang->id_barang);
        $response = $barang->barangStockChange($laporanPekerjaanBarang->qty, 2);
        if($response['status'] == 0){
            return session()->flash('fail', $response['message']);
        }

        $laporanPekerjaanBarang->update([
            'status' => 1
        ]);

        $message = 'Berhasil mengembalikan barang ke gudang';
        $this->emit('refreshBarangDiminta');
        $this->emit('refreshStockBarang');
        $this->emit('finishSimpanData', 1, $message);
        return session()->flash('success', $message);
    }
}
