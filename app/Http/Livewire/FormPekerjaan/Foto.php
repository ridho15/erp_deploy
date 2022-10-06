<?php

namespace App\Http\Livewire\FormPekerjaan;

use App\Models\ProjectFoto;
use Livewire\Component;
use Livewire\WithFileUploads;

class Foto extends Component
{
    use WithFileUploads;
    public $listeners = ['simpanFoto', 'hapusFoto'];
    public $id_project;
    public $gambar = [];
    public $listProjectFoto;
    public function render()
    {
        $this->listProjectFoto = ProjectFoto::where('id_project', $this->id_project)->get();
        return view('livewire.form-pekerjaan.foto');
    }

    public function mount($id_project){
        $this->id_project = $id_project;
    }

    public function simpanFoto(){
        $this->validate([
            'id_project' => 'required|numeric',
            'gambar.*' => 'required|mimes:jpg,png,jpeg|max:10240',
        ], [
            'id_project.required' => 'Project tidak valid !',
            'id_project.numeric' => 'Project tidak valid !',
            'gambar.*.image' => 'Gambar tidak valid !',
            'gambar.*.mimes' => 'Gambar tidak valid !',
            'gambar.*.max' => "Ukuran gambar terlalu besar. maximal 2MB"
        ]);

        if($this->gambar){
            foreach ($this->gambar as $item) {
                $path = $item->store('public/foto_project');
                $path = str_replace('public', '', $path);
                ProjectFoto::create([
                    'id_project' => $this->id_project,
                    'file' => $path
                ]);
            }

            $message = "Foto berhasil di simpan";
            $this->resetInputFields();
            $this->emit('finishSimpanData', 1, $message);
            return session()->flash('success', $message);
        }else{
            $message = "Foto Kosong";
            return session()->flash('fail', $message);
        }
    }

    public function resetInputFields(){
        $this->file = null;
    }
}
