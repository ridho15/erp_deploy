<?php

namespace App\Http\Livewire\Project;

use App\Models\ProjectUnit;
use App\Models\ProjectV2;
use Livewire\Component;

class Unit extends Component
{
    public $listeners = [
        'simpanUnit',
        'hapusUnit',
        'setProjectInUnit'
    ];
    public $listProjectUnit;
    public $no_unit;
    public $nama_unit;
    public $id_project;
    public $id_unit;

    public function render()
    {
        $this->listProjectUnit = ProjectUnit::where('id_project', $this->id_project)->get();
        return view('livewire.project.unit');
    }

    public function mount(){

    }

    public function simpanUnit(){
        $this->validate([
            'no_unit' => 'required|numeric',
            'nama_unit' => 'required|string'
        ]);

        $checkProject = ProjectV2::find($this->id_project);
        if(!$checkProject){
            $message = 'Data project tidak ditemukan !';
            return session()->flash('fail', $message);
        }

        ProjectUnit::create([
            'id_project' => $this->id_project,
            'nama_unit' => $this->nama_unit,
            'no_unit' => $this->no_unit
        ]);

        $this->nama_unit = null;
        $this->no_unit = null;
        $message = "Unit berhasil di buat";
        session()->flash('success', $message);
        return redirect()->route('project');
    }

    public function hapusUnit($id_unit){
        $this->id_unit = $id_unit;
        $projectUnit = ProjectUnit::find($this->id_unit);
        if(!$projectUnit){
            $message = "Data unit tidak ditemukan !";
            return session()->flash('fail', $message);
        }

        $projectUnit->delete();
        $this->id_unit = null;
        return session()->flash('success', 'Data unit berhasil di hapus');
    }

    public function setProjectInUnit($id_project){
        $this->id_project = $id_project;
    }
}
