<?php

namespace App\Http\Livewire\Form;

use App\Http\Controllers\HelperController;
use App\Models\FormMaster;
use Livewire\Component;
use Livewire\WithPagination;

class Data extends Component
{
    use WithPagination;
    public $paginationTheme = 'bootstrap';
    public $listeners = ['hapusForm', 'refreshForm' => '$refresh'];
    public $total_show = 10;
    public $cari;
    protected $listForm;
    public function render()
    {
        $this->listForm = FormMaster::where(function($query){
            $query->where('kode', 'LIKE', '%' . $this->cari . '%')
            ->orWhere('nama' ,'LIKE', '%' . $this->cari . '%')
            ->orWhere('keterangan', 'LIKE', '%' . $this->cari . '%');
        })->paginate($this->total_show);
        $data['listForm'] = $this->listForm;
        return view('livewire.form.data', $data);
    }

    public function mount(){

    }

    public function hapusForm($id){
        $formMaster = FormMaster::find($id);
        if(!$formMaster){
            $message = "Data Form tidak ditemukan";
            return session()->flash('fail', $message);
        }

        $formMaster->delete();
        $message = "Data form berhasil dihapus";
        activity()->causedBy(HelperController::user())->log("Menghapus data form master");
        return session()->flash('success', $message);
    }
}
