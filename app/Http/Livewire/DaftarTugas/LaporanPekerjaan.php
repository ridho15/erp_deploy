<?php

namespace App\Http\Livewire\DaftarTugas;

use App\Http\Controllers\HelperController;
use App\Models\BarangStockLog;
use App\Models\CatatanTeknisiPekerjaan;
use App\Models\LaporanPekerjaan as ModelsLaporanPekerjaan;
use App\Models\LaporanPekerjaanBarang;
use App\Models\LaporanPekerjaanFoto;
use App\Models\Quotation;
use App\Models\QuotationDetail;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class LaporanPekerjaan extends Component
{
    use WithFileUploads;
    public $listeners = [
        'simpanLaporanPekerjaan',
        'hapusFotoByIndex',
        'base64ToImage',
        'hapusFoto',
        'addCatatanTeknisi',
        'hapusCatatanTeknisi',
        'checkCatatanTeknisi'
    ];
    public $tanggal;
    public $id_laporan_pekerjaan;
    public $jam_mulai;
    public $jam_selesai;
    public $catatan_pelanggan;
    public $keterangan_laporan_pekerjaan;
    public $foto = [];
    public $keterangan_foto;
    public $signature;
    public $laporanPekerjaan;
    public $listCatatanTeknisi = [];
    public function render()
    {
        $this->listCatatanTeknisi = CatatanTeknisiPekerjaan::where('id_laporan_pekerjaan', $this->id_laporan_pekerjaan)->get();
        $this->laporanPekerjaan = ModelsLaporanPekerjaan::find($this->id_laporan_pekerjaan);
        $this->dispatchBrowserEvent('contentChange');
        return view('livewire.daftar-tugas.laporan-pekerjaan');
    }

    public function mount($id_laporan_pekerjaan){
        $this->id_laporan_pekerjaan = $id_laporan_pekerjaan;
        $this->laporanPekerjaan = ModelsLaporanPekerjaan::find($this->id_laporan_pekerjaan);
        $this->keterangan_laporan_pekerjaan = $this->laporanPekerjaan->keterangan;
        $this->catatan_pelanggan = $this->laporanPekerjaan->catatan_pelanggan;
        $this->tanggal = $this->laporanPekerjaan->jam_mulai;
        $this->jam_mulai = $this->laporanPekerjaan->jam_mulai;
        $this->jam_selesai = $this->laporanPekerjaan->jam_selesai;
        $this->signature = $this->laporanPekerjaan->signature;
    }

    public function simpanLaporanPekerjaan(){
        $this->validate([
            'catatan_pelanggan' => 'required|string',
            'foto.*' => 'required|image|mimes:jpg,png,jpeg|max:10240'
        ], [
            'catatan_pelanggan.required' => 'Catatan tidak boleh kosong',
            'catatan_pelanggan.string' => 'Catatn tidak valid !',
            'foto.*.required' => 'Foto tidak boleh kosong',
            'foto.*.image' => 'Foto tidak valid !',
            'foto.*.mimes' => 'Foto tidak valid !',
            'foto.*.max' => 'Ukuran foto terlalu besar. maximal 10MB'
        ]);

        $laporanPekerjaan = ModelsLaporanPekerjaan::find($this->id_laporan_pekerjaan);
        if(!$laporanPekerjaan){
            $message = "Laporan pekerjaan tidak valid !";
            return session()->flash('fail', $message);
        }

        // Checklist catatan Teknisi Laporan
        $catatanTeknisi = CatatanTeknisiPekerjaan::where('id_laporan_pekerjaan', $this->id_laporan_pekerjaan)
        ->where('status', '!=', null)->get();
        if(count($catatanTeknisi) == 0){
            $message = "Catatan teknisi masih ada yang belum di check. silahkan di check terlebih dahulu";
            return session()->flash('fail', $message);
        }

        $data['keterangan'] = $this->keterangan_laporan_pekerjaan;
        $data['catatan_pelanggan'] = $this->catatan_pelanggan;
        if($this->signature){
            $this->jam_selesai = now();
            $data['signature'] = $this->signature;
            $data['jam_selesai'] = $this->jam_selesai;
            $laporanPekerjaan->update($data);
            foreach ($laporanPekerjaan->laporanPekerjaanBarang as $barang) {
                if($barang->barang && $barang->status == 2){
                    BarangStockLog::create([
                        'id_barang' => $barang->id_barang,
                        'stock_awal' => $barang->barang->stock + $barang->qty,
                        'perubahan' => $barang->qty,
                        'tanggal_perubahan' => now(),
                        'id_tipe_perubahan_stock' => 1,
                        'id_user' => session()->get('id_user'),
                        'id_quotation' => $laporanPekerjaan->quotation ? $laporanPekerjaan->quotation->id : null
                    ]);

                    $barang->update([
                        'status' => 2
                    ]);
                }
            }
            $this->emit('refreshLaporanPekerjaanBarang');
            $this->createQuotation();
        }else{
            $laporanPekerjaan->update($data);
        }

        if($this->foto){
            foreach ($this->foto as $item) {
                $path = $item->store('public/asset_laporan/image');
                $path = str_replace('public', '', $path);
                LaporanPekerjaanFoto::create([
                    'id_laporan_pekerjaan' => $this->id_laporan_pekerjaan,
                    'file' => $path,
                    'keterangan' => $this->keterangan_foto
                ]);
            }
        }

        $message = "Berhasil menyimpan data laporan pekerjaan";
        activity()->causedBy(HelperController::user())->log("Menyimpan data laporan pekerjaan");
        $this->resetInputFields();
        $this->emit('finishSimpanData', 1, $message);
        return session()->flash('success', $message);
    }

    public function hapusFotoByIndex($index){
        unset($this->foto[$index]);
    }

    public function createQuotation(){
        $listSparepart = LaporanPekerjaanBarang::where('id_laporan_pekerjaan', $this->id_laporan_pekerjaan)->get();
        $laporanPekerjaan = ModelsLaporanPekerjaan::find($this->id_laporan_pekerjaan);
        $quotation = Quotation::updateOrCreate([
            'id_laporan_pekerjaan' => $this->id_laporan_pekerjaan
        ], [
            'id_laporan_pekerjaan' => $this->id_laporan_pekerjaan,
            'status' => 0,
            'id_customer' => $laporanPekerjaan->id_customer
        ]);

        if($laporanPekerjaan->jam_selesai != null && $laporanPekerjaan->signature != null){
            foreach ($listSparepart as $item) {
                if ($item->status == 2) {
                    QuotationDetail::updateOrCreate([
                        'id_quotation' => $quotation->id,
                        'id_barang' => $item->id_barang
                    ],[
                        'id_quotation' => $quotation->id,
                        'id_barang' => $item->id_barang,
                        'harga' => $item->barang->harga,
                        'qty' => $item->qty,
                        'id_satuan' => $item->barang->id_satuan,
                        'deskripsi' => $item->barang->deskripsi,
                    ]);
                }
            }
        }

        activity()->causedBy(HelperController::user())->log("Membuat quotation");
        return redirect()->route('management-tugas.export', ['id' => $laporanPekerjaan->id]);
    }

    public function resetInputFields(){
        $this->keterangan_foto = null;
        $this->foto = [];
        $this->signature = null;
    }

    public function base64ToImage($data){
        $image = $data;  // your base64 encoded
        $image = str_replace('data:image/png;base64,', '', $image);
        $image = str_replace(' ', '+', $image);
        $imageName = Str::random(10).'.'.'png';
        Storage::disk('public')->put('tanda_tangan/'.$imageName, base64_decode($image));
        $this->signature = '/tanda_tangan/' . $imageName;
        $message = "Berhasil memasang tanda tangan";
        activity()->causedBy(HelperController::user())->log("Laporan pekerjaan berhasil di tanda tangani");
        $this->emit('finishSimpanData', 1, $message);
        return session()->flash('success', $message);
        // \File::put(storage_path(). '/' . $imageName, base64_decode($image));
    }

    public function hapusFoto($id){
        $laporanPekerjaanFoto = LaporanPekerjaanFoto::find($id);
        if(!$laporanPekerjaanFoto){
            $message = "Foto tidak ditemukan !";
            return session()->flash('fail', $message);
        }

        $laporanPekerjaanFoto->delete();
        $message = "Foto berhasil dihapus";
        return session()->flash('success', $message);
    }

    public function addCatatanTeknisi($catatan_teknisi){
        if($catatan_teknisi != '' || $catatan_teknisi != null){
            CatatanTeknisiPekerjaan::updateOrCreate([
                'id_laporan_pekerjaan' => $this->id_laporan_pekerjaan,
                'keterangan' => $catatan_teknisi
            ],[
                'id_laporan_pekerjaan' => $this->id_laporan_pekerjaan,
                'keterangan' => $catatan_teknisi,
                'status' => null
            ]);
        }
    }

    public function hapusCatatanTeknisi($id){
        $catatanTeknisi = CatatanTeknisiPekerjaan::find($id);
        if($catatanTeknisi){
            $catatanTeknisi->delete();
        }
    }

    public function checkCatatanTeknisi($id, $status){
        $catatanTeknisi = CatatanTeknisiPekerjaan::find($id);
        if($catatanTeknisi){
            $catatanTeknisi->update([
                'status' => $status
            ]);
        }
    }
}
