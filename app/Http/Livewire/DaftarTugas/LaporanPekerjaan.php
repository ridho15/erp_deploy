<?php

namespace App\Http\Livewire\DaftarTugas;

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
        'hapusFoto'
    ];
    public $tanggal;
    public $id_laporan_pekerjaan;
    public $jam_mulai;
    public $jam_selesai;
    public $catatan_pelanggan;
    public $keterangan;
    public $foto = [];
    public $keterangan_foto;
    public $signature;
    public $laporanPekerjaan;
    public function render()
    {
        $this->laporanPekerjaan = ModelsLaporanPekerjaan::find($this->id_laporan_pekerjaan);
        $this->dispatchBrowserEvent('contentChange');
        return view('livewire.daftar-tugas.laporan-pekerjaan');
    }

    public function mount($id_laporan_pekerjaan){
        $this->id_laporan_pekerjaan = $id_laporan_pekerjaan;
        $this->laporanPekerjaan = ModelsLaporanPekerjaan::find($this->id_laporan_pekerjaan);
        $this->keterangan = $this->laporanPekerjaan->keterangan;
        $this->catatan_pelanggan = $this->laporanPekerjaan->catatan_pelanggan;
        $this->tanggal = $this->laporanPekerjaan->jam_mulai;
        $this->jam_mulai = $this->laporanPekerjaan->jam_mulai;
        $this->jam_selesai = $this->laporanPekerjaan->jam_selesai;
        $this->signature = $this->laporanPekerjaan->signature;
    }

    public function simpanLaporanPekerjaan(){
        $this->validate([
            'keterangan' => 'required|string',
            'catatan_pelanggan' => 'required|string',
            'foto.*' => 'required|image|mimes:jpg,png,jpeg|max:10240'
        ], [
            'keterangan.required' => 'Keterangan tidak boleh kosong',
            'keterangan.string' => 'Keterangan tidak valid !',
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

        $data['keterangan'] = $this->keterangan;
        $data['catatan_pelanggan'] = $this->catatan_pelanggan;
        if($this->signature){
            $this->jam_selesai = now();
            $data['signature'] = $this->signature;
            $data['jam_selesai'] = $this->jam_selesai;
            $laporanPekerjaan->update($data);
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
                    'keterangan' => $this->keterangan
                ]);
            }
        }

        $message = "Berhasil menyimpan data laporan pekerjaan";
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
        ]);

        if($laporanPekerjaan->jam_selesai != null && $laporanPekerjaan->signature != null){
            foreach ($listSparepart as $item) {
                QuotationDetail::create([
                    'id_quotation' => $quotation->id,
                    'id_barang' => $item->id_barang,
                    'harga' => $item->barang->harga,
                    'qty' => $item->qty,
                    'id_satuan' => $item->barang->id_satuan,
                    'deskripsi' => $item->barang->deskripsi
                ]);
            }
        }
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
}
