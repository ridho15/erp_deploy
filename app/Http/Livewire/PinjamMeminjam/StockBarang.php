<?php

namespace App\Http\Livewire\PinjamMeminjam;

use App\Models\Barang;
use Livewire\Component;
use Livewire\WithPagination;

class StockBarang extends Component
{
    use WithPagination;
    public $listeners = [
        'refreshStockBarang' => '$refresh'
    ];
    public $paginationTheme = 'bootstrap';
    public $cari;
    public $arrayCari;
    public $total_show = 10;
    protected $listBarang;
    public $stockKurang = false;
    public function render()
    {
        if($this->cari){
            $this->arrayCari = explode('-', $this->cari);
            $cariBarang = array_key_exists(0, $this->arrayCari) ? $this->arrayCari[0] : null;
            $merk = array_key_exists(1, $this->arrayCari) ? $this->arrayCari[1] : null;
            $satuan = array_key_exists(2, $this->arrayCari) ? $this->arrayCari[2] : null;
            $tipeBarang = array_key_exists(3, $this->arrayCari) ? $this->arrayCari[3] : null;
            $deskripsi = array_key_exists(4, $this->arrayCari) ? $this->arrayCari[4] : null;
            $this->listBarang = Barang::where(function($query)use($cariBarang,$merk,$satuan,$tipeBarang,$deskripsi){
                // $query->where('nama', 'LIKE', '%' . $cariBarang . '%')
                // ->where('deskripsi', 'LIKE', '%' . $deskripsi . '%')
                // ->whereHas('satuan', function($query)use($satuan){
                //     $query->where('nama_satuan', 'LIKE', '%' . $satuan . '%');
                // })->whereHas('tipeBarang', function($query)use($tipeBarang){
                //     $query->where('tipe_barang', 'LIKE' ,'%' . $tipeBarang . '%');
                // })->whereHas('merk', function($query)use($merk){
                //     $query->where('nama_merk', 'LIKE', '%' . $merk . '%');
                // });
                $query->where('nomor', 'LIKE', '%' . $this->cari . '%')
                ->orWhere('nama', 'LIKE', '%' . $this->cari . '%')
                ->orWhereHas('merk', function($query){
                    $query->where('nama_merk', 'LIKE', '%' . $this->cari . '%');
                });
            })->orderBy('stock', 'ASC')->paginate($this->total_show);
        }else{
            $this->listBarang = Barang::orderBy('stock', 'ASC')->paginate($this->total_show);
        }

        $data['listBarang'] = $this->listBarang;
        return view('livewire.pinjam-meminjam.stock-barang', $data);
    }

    public function mount(){

    }
}
