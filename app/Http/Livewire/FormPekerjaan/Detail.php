<?php

namespace App\Http\Livewire\FormPekerjaan;

use App\Models\Project;
use Livewire\Component;

class Detail extends Component
{
    public $listeners = ['refreshProject' => '$refresh'];
    public $id_project;
    public $project;
    public function render()
    {
        $this->project = Project::find($this->id_project);
        return view('livewire.form-pekerjaan.detail');
    }

    public function mount($id_project){
        $this->id_project = $id_project;
    }
}
