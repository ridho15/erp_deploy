<?php

namespace App\Http\Livewire\Project;

use App\Http\Controllers\HelperController;
use App\Models\ProjectV2;
use Livewire\Component;
use Livewire\WithPagination;

class Data extends Component
{
    use WithPagination;
    public $listeners = ['hapusProject', 'refreshProject' => '$refresh'];
    public $paginationTheme = 'bootstrap';
    public $total_show = 10;
    public $cari;
    protected $listProject;
    public function render()
    {
        $this->listProject = ProjectV2::where(function($query){
            $query->where('kode', 'LIKE', '%' . $this->cari . '%')
            ->orWhere('nama', 'LIKE', '%' . $this->cari . '%')
            ->orWhere('alamat', 'LIKE', '%' . $this->cari . '%')
            ->orWhere('catatan', 'LIKE', '%' . $this->cari . '%')
            ->orWhere('tanggal', 'LIKE', '%' . $this->cari . '%')
            ->orWhere('penanggung_jawab', 'LIKE', '%' . $this->cari . '%')
            ->orWhereHas('customer', function($query){
                $query->where('nama', 'LIKE', '%' . $this->cari . '%');
            });
        })->paginate($this->total_show);
        $data['listProject'] = $this->listProject;
        return view('livewire.project.data', $data);
    }

    public function hapusProject($id){
        $project = ProjectV2::find($id);
        if(!$project){
            $message = "Data Project tidak ditemukan !";
            return session()->flash('fail', $message);
        }

        $project->delete();
        $message = "Data Project berhasil dihapus";
        activity()->causedBy(HelperController::user())->log("Menghapus data project");
        return session()->flash('success', $message);
    }
}
