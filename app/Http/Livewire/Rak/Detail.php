<?php

namespace App\Http\Livewire\Rak;

use App\Http\Controllers\HelperController;
use App\Models\IsiRak;
use App\Models\Rak;
use Livewire\Component;
use Livewire\WithPagination;

class Detail extends Component
{
    use WithPagination;
    public $paginationTheme = 'bootstrap';
    public $listeners = [
        'refreshRak' => '$refresh',
        'hapusIsiRak'
    ];

    public $total_show = 10;
    public $cari;
    public $id_rak;
    protected $listIsiRak;
    public $rak;
    public function render()
    {
        $this->listIsiRak = IsiRak::where('id_rak', $this->id_rak)
        ->where(function($query){
            $query->whereHas('barang', function($query){
                $query->where('nama', 'LIKE', '%' . $this->cari . '%');
            });
        })->paginate($this->total_show);

        $data['listIsiRak'] = $this->listIsiRak;
        return view('livewire.rak.detail', $data);
    }

    public function mount($id_rak){
        $this->id_rak = $id_rak;
        $this->rak = Rak::find($this->id_rak);
    }

    public function hapusIsiRak($id){
        $isiRak = IsiRak::find($id);
        if(!$isiRak){
            $message = 'Data isi rak tidak ditemukan !';
            return session()->flash('fail', $message);
        }

        $isiRak->delete();
        $message = "Data isi rak berhasil di hapus";
        activity()->causedBy(HelperController::user())->log("Menghapus data isi rak");
        return session()->flash('success', $message);
    }
}
