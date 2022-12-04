<?php

namespace App\Http\Livewire\TipePembayaran;

use App\Http\Controllers\HelperController;
use App\Models\TipePembayaran;
use Livewire\Component;
use Livewire\WithPagination;

class Data extends Component
{
    use WithPagination;
    public $paginationTheme = 'bootstrap';
    public $listeners = [
        'refreshUser' => '$refresh',
        'clickTambah',
        'hapusUser',
    ];
    public $total_show = 10;
    public $cari;
    protected $listUser;
    public $angka = 0;

    public function render()
    {
        $this->listUser = TipePembayaran::where(function ($query) {
            $query->where('nama_tipe', 'LIKE', '%'.$this->cari.'%');
        })->paginate();
        $data['listUser'] = $this->listUser;

        return view('livewire.tipe-pembayaran.data', $data);
    }

    public function mount()
    {
    }

    public function hapusUser($id)
    {
        $TipePembayaran = TipePembayaran::find($id);
        if (!$TipePembayaran) {
            $message = 'Data tidak ditemukan';

            return $this->emit('finishDataUser', 0, $message);
        }

        $TipePembayaran->delete();
        $message = 'Berhasil menghapus data';
        activity()->causedBy(HelperController::user())->log("Menghapus tipe pembayaran");
        return $this->emit('finishDataUser', 1, $message);
    }

    public function clickTambah()
    {
        ++$this->angka;
    }
}
