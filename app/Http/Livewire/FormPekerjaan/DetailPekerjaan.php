<?php

namespace App\Http\Livewire\FormPekerjaan;

use App\Http\Controllers\HelperController;
use App\Models\ProjectDetail;
use App\Models\ProjectDetailSub;
use Livewire\Component;

class DetailPekerjaan extends Component
{
    public $listeners = ['finishProjectDetail'];
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

    public function finishProjectDetail($id){
        $projectDetail = ProjectDetail::find($id);
        if(!$projectDetail){
            $message = "Data tidak ditemukan !";
            return session()->flash('fail', $message);
        }

        $projectDetail->update([
            'status' => 1,
            'jam_selesai' => now()
        ]);

        $message = "Berhasil mensubmit pekerjaan";
        activity()->causedBy(HelperController::user())->log("Menyelesaikan form master pekerjaan");
        return session()->flash('success', $message);
    }
}
