<?php

namespace App\Http\Livewire\Merk;

use App\Http\Controllers\HelperController;
use App\Models\Merk;
use Livewire\Component;
use Livewire\WithPagination;

class Data extends Component
{
    use WithPagination;
    public $paginationTheme = 'bootstrap';
    public $total_show = 10;
    public $cari;
    protected $listMerk;
    public $listeners = ['refreshDataMerk' => '$refresh','hapusMerk'];
    public function render()
    {
        $this->listMerk = Merk::where(function($query){
            $query->where('nama_merk', 'LIKE', '%' . $this->cari . '%');
        })->paginate($this->total_show);
        $data['listMerk'] = $this->listMerk;
        return view('livewire.merk.data', $data);
    }

    public function mount(){

    }

    public function hapusMerk($id){
        $merk = Merk::find($id);
        if(!$merk){
            $message = "Merk tidak ditemukan";
            $this->emit('finishDataMerk', 0, $message);
            return session()->flash('fail', $message);
        }

        $merk->delete();
        $message = 'Data merk berhasil di hapus';
        activity()->causedBy(HelperController::user())->log("Menghapus data merk");

        $this->emit('finishDataMerk', 1, $message);
        return session()->flash('success', $message);
    }
}
