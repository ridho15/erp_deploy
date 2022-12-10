<?php

namespace App\Http\Livewire\PinjamMeminjam;

use App\Http\Controllers\HelperController;
use App\Models\Barang;
use App\Models\LaporanPekerjaanBarang;
use App\Models\LaporanPekerjaanBarangLog;
use App\Models\NomorPeminjamanHarian;
use App\Models\Rak;
use App\Models\RakLog;
use Livewire\Component;
use Livewire\WithPagination;

class AcureateKeluar extends Component
{
    use WithPagination;
    public $listeners = [
        'refreshAcurateKeluar' => '$refresh',
        'simpanCheck'
    ];
    public $paginationTheme = 'bootstrap';
    public $total_show = 10;
    public $cari;

    protected $listAcurateKeluar;

    public $nomor_itt;
    public $id_laporan_pekerjaan_barang;
    public function render()
    {
        $this->listAcurateKeluar = LaporanPekerjaanBarang::whereHas('barang')
        ->where(function($query){
            $query->where('catatan_teknisi', 'LIKE', '%' . $this->cari . '%')
            ->orWhere('keterangan_customer', 'LIKE', '%' . $this->cari . '%')
            ->orWhere('qty', 'LIKE', '%' . $this->cari . '%')
            ->orWhereHas('barang', function($query){
                $query->where('nama', 'LIKE', '%' . $this->cari . '%');
            });
        })->where('status', 1)->where('konfirmasi', 1)->orderBy('updated_at', 'DESC')
        ->paginate($this->total_show);

        $data['listAcurateKeluar'] = $this->listAcurateKeluar;

        return view('livewire.pinjam-meminjam.acureate-keluar', $data);
    }

    public function simpanCheck($id){
        $laporanPekerjaanBarang = LaporanPekerjaanBarang::find($id);
        if(!$laporanPekerjaanBarang){
            $message = "Data laporan pekerjaan barang tidak ditemukan";
            return session()->flash('fail', $message);
        }

        // Check Nomor ITT Harian
        $checkNomorITTHarian = NomorPeminjamanHarian::where('itt_start', '<', $this->nomor_itt)
        ->where('itt_end', '>', $this->nomor_itt)->whereDate('tanggal', now())
        ->first();

        if(!$checkNomorITTHarian){
            $message = "Nomor ITT yang dimasukkan tidak valid !";
            return session()->flash('fail', $message);
        }

        // $barang = Barang::find($laporanPekerjaanBarang->id_barang);
        // if($laporanPekerjaanBarang->laporanPekerjaan->quotation){
        //     $id_quotation = $laporanPekerjaanBarang->laporanPekerjaan->quotation->id;
        // }else{
        //     $id_quotation = null;
        // }
        // $response = $barang->barangStockChange($laporanPekerjaanBarang->qty, 1, $id_quotation);

        // if($response['status'] == 0){
        //     return session()->flash('fail', $response['message']);
        // }

        $laporanPekerjaanBarang->update([
            'status' => 2,
            'konfirmasi' => 0,
            'nomor_itt' => $this->nomor_itt,
        ]);

        LaporanPekerjaanBarangLog::create([
            'id_laporan_pekerjaan_barang' => $laporanPekerjaanBarang->id,
            'status' => 2
        ]);

        $rak = Rak::find($laporanPekerjaanBarang->id_rak);
        if($rak){
            $qty = $laporanPekerjaanBarang->qty;
            $jumlahBarangRak = $rak->isiRak->where('id_barang', $laporanPekerjaanBarang->id_barang)->sum('jumlah');
            if($jumlahBarangRak < $qty){
                $message = "Jumlah barang pada rak tidak mencukupi. silahkan isi rak terlebih dahulu";
                return session()->flash('fail', $message);
            }
            foreach ($rak->isiRak->where('id_barang', $laporanPekerjaanBarang->id_barang) as $isiRak) {
                if($isiRak->jumlah >= $qty){
                    $isiRak->update([
                        'jumlah' => $isiRak->jumlah - $qty
                    ]);

                    RakLog::create([
                        'id_rak' => $rak->id,
                        'id_barang' => $isiRak->id_barang,
                        'status' => 2,
                        'jumlah' => $qty,
                        'keterangan' => 'Barang Keluar Diminta'
                    ]);
                }else{
                    $qty -= $isiRak->jumlah;
                    RakLog::create([
                        'id_rak' => $rak->id,
                        'id_barang' => $isiRak->id_barang,
                        'status' => 2,
                        'jumlah' => $isiRak->jumlah,
                        'keterangan' => 'Barang Keluar Diminta'
                    ]);
                    $isiRak->update([
                        'jumlah' => 0
                    ]);

                }
            }
        }

        $message = "Berhasil mengkonfirmasi data";
        activity()->causedBy(HelperController::user())->log("Mengkonfirmasi barang accurate keluar");
        $this->emit('refreshBarangDipinjam');
        $this->emit('refreshBarangDikasih');
        return session()->flash('success', $message);
    }
}
