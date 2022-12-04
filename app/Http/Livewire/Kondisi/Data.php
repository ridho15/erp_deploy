<?php

namespace App\Http\Livewire\Kondisi;

use App\Http\Controllers\HelperController;
use App\Models\Kondisi;
use Livewire\Component;
use Livewire\WithPagination;

class Data extends Component
{
    use WithPagination;
    public $paginationTheme = 'bootstrap';
    public $listeners = ['refreshKondisi' => '$refresh', 'hapusKondisi'];
    protected $listKondisi;
    public $total_show = 10;
    public $cari;
    public function render()
    {
        $this->listKondisi = Kondisi::where(function($query){
            $query->where('kode', 'LIKE', '%' . $this->cari . '%')
            ->orWhere('keterangan', 'LIKE', '%' . $this->cari . '%');
        })->paginate($this->total_show);
        $data['listKondisi'] = $this->listKondisi;
        return view('livewire.kondisi.data', $data);
    }

    public function mount(){

    }

    public function hapusKondisi($id){
        $kondisi = Kondisi::find($id);
        if(!$kondisi){
            $message = "Data Kondisi Tidak ditemukan";
            return session()->flash('fail', $message);
        }

        $kondisi->delete();
        $message = "Berhasil menghapus data kondisi";
        activity()->causedBy(HelperController::user())->log("Menghapus data kondisi");
        $this->emit('finishRefreshKondisi', 1, $message);
        return session()->flash('success', $message);
    }
}
