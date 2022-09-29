<?php

namespace App\Http\Livewire\Worker;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Data extends Component
{
    use WithPagination;
    public $paginationTheme = 'bootstrap';
    public $listeners = [
        'refreshUser' => '$refresh',
        'clickTambah'
    ];
    public $total_show = 10;
    public $cari;
    protected $listUser;
    public $angka = 0;
    public function render()
    {
        $this->listUser = User::where(function($query){
            $query->where('name', 'LIKE','%' . $this->cari . '%')
            ->orWhere('username', 'LIKE','%' . $this->cari . '%');
        })->paginate();
        $data['listUser'] = $this->listUser;
        return view('livewire.worker.data', $data);
    }

    public function mount(){

    }

    public function hapusUser($id){
        $user = User::find($id);
        if(!$user){
            $message = "Data tidak ditemukan";
            return $this->emit('finishUser', 0, $message);
        }

        $user->delete();
        $message = 'Berhasil menghapus data';
        return $this->emit('finishUser', 1, $message);
    }

    public function clickTambah(){
        $this->angka ++;
    }
}
