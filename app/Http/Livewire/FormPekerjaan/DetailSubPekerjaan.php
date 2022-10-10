<?php

namespace App\Http\Livewire\FormPekerjaan;

use App\Models\ProjectDetail;
use App\Models\ProjectDetailSub;
use Livewire\Component;

class DetailSubPekerjaan extends Component
{
    public $listeners = ['refreshProjectDetailSub' => '$refresh','hapusProjectDetailSub'];
    public $id_project_detail;
    public $listProjectDetailSub;
    public $projectDetail;
    public function render()
    {
        $this->projectDetail = ProjectDetail::find($this->id_project_detail);
        $this->listProjectDetailSub = ProjectDetailSub::where('id_project_detail', $this->id_project_detail)->get();
        return view('livewire.form-pekerjaan.detail-sub-pekerjaan');
    }

    public function mount($id_project_detail){
        $this->id_project_detail = $id_project_detail;
    }

    public function hapusProjectDetailSub($id){
        $projectDetailSub = ProjectDetailSub::find($id);
        if(!$projectDetailSub){
            $message = "Data Pekerjaan tidak ditemukan";
            return session()->flash('fail', $message);
        }

        $projectDetailSub->delete();
        $message = "Data Pekerjaan berhasil dihapus";
        $this->emit('finishRefreshData', 1, $message);
        return session()->flash('success', $message);
    }
}
