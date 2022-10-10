<?php

namespace App\Http\Livewire\FormPekerjaan;

use App\Models\ProjectDetailSub;
use App\Models\ProjectDetailSubFoto as ModelsProjectDetailSubFoto;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProjectDetailSubFoto extends Component
{
    use WithFileUploads;
    public $listeners = ['setProjectDetailSubFoto', 'hapusFoto'];
    public $id_project_detail_sub;
    public $foto;
    public $file;
    public $listFoto = [];
    public function render()
    {
        $this->listFoto = ModelsProjectDetailSubFoto::where('id_project_detail_sub', $this->id_project_detail_sub)->get();
        return view('livewire.form-pekerjaan.project-detail-sub-foto');
    }

    public function mount(){
    }

    public function setProjectDetailSubFoto($id){
        $projectDetailSub = ProjectDetailSub::find($id);
        if(!$projectDetailSub){
            $message = "Data tidak ditemukan !";
            return session()->flash('fail', $message);
        }

        $this->id_project_detail_sub = $projectDetailSub->id;
    }

    public function hapusFoto($id){
        $projectDetailSubFoto = ProjectDetailSubFoto::find($id);
        if(!$projectDetailSubFoto){
            $message = "Data Foto tidak ditemukan !";
            return session()->flash('fail', $message);
        }

        $projectDetailSubFoto->delete();
        $message = "Berhasil menghapus foto";
        return session()->flash('fail', $message);
    }
}
