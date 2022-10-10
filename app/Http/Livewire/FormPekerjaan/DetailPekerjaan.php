<?php

namespace App\Http\Livewire\FormPekerjaan;

use App\Models\ProjectDetail;
use App\Models\ProjectDetailSub;
use Livewire\Component;

class DetailPekerjaan extends Component
{
    public $id_project_detail;
    public $projectDetail;
    public $listPekerja;
    public function render()
    {
        $this->projectDetail = ProjectDetail::find($this->id_project_detail);
        $this->listPekerja = ProjectDetailSub::where('id_project_detail', $this->id_project_detail)->get();
        return view('livewire.form-pekerjaan.detail-pekerjaan');
    }

    public function mount($id_project_detail){
        $this->id_project_detail = $id_project_detail;
    }
}
