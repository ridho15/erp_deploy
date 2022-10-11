<?php

namespace App\Http\Livewire\FormPekerjaan;

use App\Models\ProjectDetail;
use Livewire\Component;
use Livewire\WithPagination;

class ListDetail extends Component
{
    use WithPagination;
    public $paginationTheme = 'bootstrap';
    public $listeners = [
        'refreshProjectDetail' => '$refresh',
        'hapusProjectDetail'
    ];
    public $id_project;
    protected $listProjectDetail;
    public $total_show = 10;
    public $cari;
    public function render()
    {
        $this->listProjectDetail = ProjectDetail::where(function($query){
            $query->where('nama_pekerjaan', 'LIKE', '%' . $this->cari . '%')
            ->orWhere('keterangan', 'LIKE', '%' . $this->cari . '%');
        })
        ->where('id_project', $this->id_project)->paginate($this->total_show);
        $data['listProjectDetail'] = $this->listProjectDetail;
        return view('livewire.form-pekerjaan.list-detail', $data);
    }

    public function mount($id_project = null){
        $this->id_project = $id_project;
    }

    public function hapusProjectDetail($id){
        $projectDetail = ProjectDetail::find($id);
        if(!$projectDetail){
            $message = "Project detail tidak ditemukan";
            return session()->flash('fail', $message);
        }

        $projectDetail->delete();
        $message = "Berhasil menghapus project detail";
        $this->emit('finishRefreshProject', 1, $message);
        return session()->flash('success', $message);
    }
}
