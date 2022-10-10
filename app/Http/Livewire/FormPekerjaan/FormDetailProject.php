<?php

namespace App\Http\Livewire\FormPekerjaan;

use App\Models\Project;
use App\Models\ProjectDetail;
use App\Models\User;
use Livewire\Component;

class FormDetailProject extends Component
{
    public $listeners = [
        'setIdProject',
        'simpanDataProjectDetail',
        'setDataProjectDetail'
    ];
    public $id_project_detail;
    public $id_project;
    public $nama_pekerjaan;
    public $status;
    public $keterangan;
    public $project;
    public $listPekerja;
    public function render()
    {
        $this->project = Project::find($this->id_project);
        $this->dispatchBrowserEvent('contentChange');
        return view('livewire.form-pekerjaan.form-detail-project');
    }

    public function mount(){

    }

    public function setIdProject($id_project){
        $this->id_project = $id_project;
    }

    public function simpanDataProjectDetail(){
        $this->validate([
            'id_project' => 'required|numeric',
            'nama_pekerjaan' => 'required|string',
            'keterangan' => 'nullable|string',
        ], [
            'id_project.required' => 'Project tidak valid !',
            'id_project.numeric' => 'Project tidak valid !',
            'nama_pekerjaan.required' => 'Nama pekerjaan tidak boleh kosong',
            'nama_pekerjaan.string' => 'Nama pekerjaan tidak valid !',
            'keterangan.string' => 'Keterangan tidak valid !',
        ]);

        // Check Project
        $project = Project::find($this->id_project);
        if(!$project){
            $message = "Data project tidak ditemukan !";
            return session()->flash('fail', $message);
        }

        ProjectDetail::updateOrCreate([
            'id' => $this->id_project_detail
        ], [
            'id_project' => $this->id_project,
            'nama_pekerjaan' => $this->nama_pekerjaan,
            'id_user' => $this->id_user,
            'keterangan' => $this->keterangan,
        ]);

        $message = "Berhasil menyimpan data project detail";
        $this->resetInputFields();
        $this->emit('refreshProjectDetail');
        $this->emit('finishSimpanData', 1, $message);
        return session()->flash('success', $message);
    }

    public function setDataProjectDetail($id){
        $projectDetail = ProjectDetail::find($id);
        if(!$projectDetail){
            $message = "Project detail tidak ditemukan !";
            return session()->flash('fail', $message);
        }

        $this->id_project_detail = $projectDetail->id;
        $this->id_project = $projectDetail->id_project;
        $this->nama_pekerjaan = $projectDetail->nama_pekerjaan;
        $this->status = $projectDetail->status;
        $this->id_user = $projectDetail->id_user;
        $this->keterangan = $projectDetail->keterangan;
        $this->jam_mulai = $projectDetail->jam_mulai;
        $this->jam_selesai = $projectDetail->jam_selesai;
    }

    public function resetInputFields(){
        $this->id_project_detail = null;
        $this->id_project = null;
        $this->nama_pekerjaan = null;
        $this->status = null;
        $this->id_user = null;
        $this->keterangan = null;
        $this->jam_mulai = null;
        $this->jam_selesai = null;
    }
}
