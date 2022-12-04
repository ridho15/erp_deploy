<?php

namespace App\Http\Livewire\FormPekerjaan;

use App\Http\Controllers\HelperController;
use App\Models\ProjectDetailSub;
use App\Models\ProjectDetailSubFoto as ModelsProjectDetailSubFoto;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProjectDetailSubFoto extends Component
{
    use WithFileUploads;
    public $listeners = ['simpanFoto', 'hapusFoto', 'changeShowForm', 'setDetailFoto'];
    public $id_project_detail_sub;
    public $foto;
    public $file;
    public $showForm = false;
    public $listFoto = [];
    public function render()
    {
        $this->listFoto = ModelsProjectDetailSubFoto::where('id_project_detail_sub', $this->id_project_detail_sub)->get();
        return view('livewire.form-pekerjaan.project-detail-sub-foto');
    }

    public function mount(){
    }

    public function setDetailFoto($id){
        $projectDetailSub = ProjectDetailSub::find($id);
        if(!$projectDetailSub){
            $message = "Data tidak ditemukan !";
            return session()->flash('fail', $message);
        }

        $this->id_project_detail_sub = $projectDetailSub->id;
    }

    public function hapusFoto($id){
        $projectDetailSubFoto = ModelsProjectDetailSubFoto::find($id);
        if(!$projectDetailSubFoto){
            $message = "Data Foto tidak ditemukan !";
            return session()->flash('fail', $message);
        }

        $projectDetailSubFoto->delete();
        $message = "Berhasil menghapus foto";
        return session()->flash('success', $message);
    }

    public function changeShowForm(){
        $this->showForm = !$this->showForm;
    }

    public function simpanFoto(){
        $this->validate([
            'file.*' => 'required|image|mimes:jpg,png,jpeg|max:10240'
        ], [
            'file.*.required' => 'File tidak boleh kosong',
            'file.*.image' => 'File tidak valid !',
            'file.*.max' => 'File terlalu besar'
        ]);

        if($this->file){
            foreach ($this->file as $index => $item) {
                $path = $item->store('public/asset/foto_pekerjaan');
                $path = str_replace('public', '', $path);
                ModelsProjectDetailSubFoto::create([
                    'id_project_detail_sub' => $this->id_project_detail_sub,
                    'file' => $path
                ]);
            }
        }

        $message = "Berhasil menyimpan gambar";
        activity()->causedBy(HelperController::user())->log("Menyimpan gambar sub pekerjaan");
        $this->resetInputFields();
        return session()->flash('success', $message);
    }

    public function resetInputFields(){
        $this->file = null;
    }
}
