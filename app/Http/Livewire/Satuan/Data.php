<?php

namespace App\Http\Livewire\Satuan;

use App\Models\Satuan;
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
        $this->listUser = Satuan::where(function ($query) {
            $query->where('nama_satuan', 'LIKE', '%'.$this->cari.'%');
        })->paginate();
        $data['listUser'] = $this->listUser;

        return view('livewire.satuan.data', $data);
    }

    public function mount()
    {
    }

    public function hapusUser($id)
    {
        $user = Satuan::find($id);
        if (!$user) {
            $message = 'Data tidak ditemukan';

            return $this->emit('finishDataUser', 0, $message);
        }

        $user->delete();
        $message = 'Berhasil menghapus data';

        return $this->emit('finishDataUser', 1, $message);
    }

    public function clickTambah()
    {
        ++$this->angka;
    }
}
