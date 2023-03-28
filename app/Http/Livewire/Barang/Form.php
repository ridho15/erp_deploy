<?php

namespace App\Http\Livewire\Barang;

use App\Http\Controllers\HelperController;
use App\Models\Barang;
use App\Models\Merk;
use App\Models\Satuan;
use App\Models\TipeBarang;
use Livewire\Component;

class Form extends Component
{
    protected $helper;

    public function __construct()
    {
        $this->helper = new HelperController();
    }

    public $listeners = [
        'setDataBarang',
        'simpanDataBarang',
        'changeTipeBarang',
        'changeMerk',
        'changeSatuan',
        'changeVersion'
    ];
    public $id_barang;
    public $nama;
    public $harga;
    public $harga_modal;
    public $id_merk;
    public $min_stock;
    public $id_satuan;
    public $id_tipe_barang;
    public $listMerk;
    public $listTipeBarang;
    public $listSatuan;
    public $deskripsi;
    public $version;
    public $nomor;

    public $listVersion = [];

    public function render()
    {
        $this->listMerk = Merk::get();
        $this->listTipeBarang = TipeBarang::get();
        $this->listSatuan = Satuan::get();
        $this->listVersion = HelperController::getListVersion();

        $this->dispatchBrowserEvent('contentChange');

        return view('livewire.barang.form');
    }

    public function mount()
    {
    }

    public function resetInputFields()
    {
        $this->id_barang = null;
        $this->nama = null;
        $this->harga = null;
        $this->id_merk = null;
        $this->id_tipe_barang = null;
        $this->min_stock = null;
        $this->version = null;
        $this->nomor = null;
    }

    public function simpanDataBarang()
    {
        $this->validate([
            'nama' => 'required|string',
            'harga' => 'required|numeric',
            'id_merk' => 'required|numeric',
            'min_stock' => 'required|numeric',
            'id_satuan' => 'required|numeric',
            'id_tipe_barang' => 'required|numeric',
            'deskripsi' => 'nullable|string',
            'harga_modal' => 'required|numeric',
            'version' => 'required|numeric',
            'nomor' => 'required|numeric',
        ], [
            'nama.required' => 'Nama tidak boleh kosong',
            'nama.string' => 'Nama tidak valid !',
            'harga.required' => 'Harga tidak boleh kosong',
            'harga.numeric' => 'Harga tidak valid !',
            'id_merk.numeric' => 'Merk tidak valid !',
            'min_stock.required' => 'Minimal Stock Barang tidak boleh kosong',
            'min_stock.numeric' => 'Minimal Stock Barang tidak valid !',
            'id_satuan.required' => 'Satuan Belum dipilih',
            'id_satuan.numeric' => 'Satuan tidak valid',
            'id_tipe_barang.required' => 'Tipe barang belum dipilih',
            'id_tipe_barang.numeric' => 'Tipe barang tidak valid !',
            'deskripsi.string' => 'Deskripsi barang tidak valid !',
            'harga_modal.required' => 'Harga modal tidak boleh kosong',
            'harga_modal.numeric' => 'Harga modal tidak valid !',
            'nomor.required' => 'SKU tidak boleh kosong',
            'nomor.numeric' => 'SKU tidak valid !',
        ]);

        // Check Merk
        if ($this->id_merk) {
            $merk = Merk::find($this->id_merk);
            if ($merk) {
                $data['id_merk'] = $this->id_merk;
            }
        }

        $tipeBarang = TipeBarang::find($this->id_tipe_barang);
        if (!$tipeBarang) {
            $message = "Tipe barang tidak ditemukan !";
            return session()->flash('fail', $message);
        }

        if ($this->min_stock < 0) {
            $message = "Minimal stock tidak valid !. minimal adalah 0";
            return session()->flash('fail', $message);
        }

        // Pasangt stok & Check SKU;
        $barang = Barang::find($this->id_barang);
        if ($barang) {
            $data['stock'] = $barang->stock;
            if ($this->nomor != $barang->nomor) {
                $checkNomor = $this->checkNomor();
                if ($checkNomor['status'] == 0) {
                    return session()->flash('fail', $checkNomor['message']);
                }
            }
        } else {
            $data['stock'] = 0;
            $checkNomor = $this->checkNomor();
            if ($checkNomor['status'] == 0) {
                return session()->flash('fail', $checkNomor['message']);
            }
        }

        $data['nama'] = $this->nama;
        $data['harga'] = $this->harga;
        $data['min_stock'] = $this->min_stock;
        $data['id_satuan'] = $this->id_satuan;
        $data['id_merk'] = $this->id_merk;
        $data['id_tipe_barang'] = $this->id_tipe_barang;
        $data['deskripsi'] = $this->deskripsi;
        $data['harga_modal'] = $this->harga_modal;
        $data['version'] = $this->version;
        $data['nomor'] = $this->nomor;

        Barang::updateOrCreate([
            'id' => $this->id_barang
        ], $data);

        $message = 'Berhasil menyimpan data barang';
        activity()->causedBy(HelperController::user())->log("Menyimpan data barang");
        $this->resetInputFields();
        $this->emit('refreshDataBarang');
        $this->emit('finishSimpanData', 1, $message);

        return session()->flash('success', $message);
    }

    public function checkNomor()
    {
        $checkNomor = Barang::where('nomor', $this->nomor)->first();
        if ($checkNomor) {
            $message = "Nomor SKU sudah digunakan";
            return [
                'status' => 0,
                'message' => $message
            ];
        } else {
            return [
                'status' => 1,
                'message' => 'Berhasil'
            ];
        }
    }

    public function setDataBarang($id)
    {
        $barang = Barang::find($id);
        if (!$barang) {
            $message = 'Barang tidak ditemukan';
            $this->emit('finishRefreshBarang', 0, $message);

            return session()->flash('fail', $message);
        }

        $this->id_barang = $barang->id;
        $this->nama = $barang->nama;
        $this->harga = $barang->harga;
        $this->id_merk = $barang->id_merk;
        $this->stock = $barang->stock;
        $this->min_stock = $barang->min_stock;
        $this->id_satuan = $barang->id_satuan;
        $this->id_tipe_barang = $barang->id_tipe_barang;
        $this->deskripsi = $barang->deskripsi;
        $this->harga_modal = $barang->harga_modal;
        $this->version = $barang->version;
        $this->nomor = $barang->nomor;
    }

    public function changeTipeBarang($id_tipe_barang)
    {
        $this->id_tipe_barang = $id_tipe_barang;
    }

    public function changeMerk($id_merk)
    {
        $this->id_merk = $id_merk;
    }

    public function changeSatuan($id_satuan)
    {
        $this->id_satuan = $id_satuan;
    }

    public function changeVersion($version)
    {
        $this->version = $version;
    }
}
