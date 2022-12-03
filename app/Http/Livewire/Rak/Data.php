<?php

namespace App\Http\Livewire\Rak;

use App\Models\Rak;
use Livewire\Component;
use Livewire\WithPagination;

class Data extends Component
{
    use WithPagination;
    public $paginationTheme = 'bootstrap';
    public $listeners = [
        'refreshRak' => '$refresh',
        'hapusRak'
    ];
    public $cari;
    public $total_show;

    protected $listRak;
    public function render()
    {
        $this->listRak = Rak::where(function($query){
            $query->where('kode_rak', 'LIKE','%' . $this->cari . '%')
            ->orWhere('nama_rak', 'LIKE', '%' . $this->cari . '%');
        })->paginate($this->total_show);

        $data['listRak'] = $this->listRak;
        return view('livewire.rak.data', $data);
    }

    public function mount(){

    }

    public function hapusRak($id){
        $rak = Rak::find($id);
        if(!$rak){
            $message = "Data rak tidak ditemukan !";
            return session()->flash('fail', $message);
        }

        $rak->delete();
        $message = "Rak berhasil di hapus";
        return session()->flash('success', $message);
    }
}
