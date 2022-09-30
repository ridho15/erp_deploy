<?php

namespace App\Http\Livewire\TipeUser;

use App\Models\TipeUser;
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
        $this->listUser = TipeUser::where(function ($query) {
            $query->where('nama_tipe', 'LIKE', '%'.$this->cari.'%');
        })->paginate();
        $data['listUser'] = $this->listUser;

        return view('livewire.tipe-user.data', $data);
    }

    public function mount()
    {
    }

    public function hapusUser($id)
    {
        $user = TipeUser::find($id);
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
