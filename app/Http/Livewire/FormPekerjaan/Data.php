<?php

namespace App\Http\Livewire\FormPekerjaan;

use App\Http\Controllers\HelperController;
use App\Models\Project;
use Livewire\Component;
use Livewire\WithPagination;

class Data extends Component
{
    protected $helper;
    function __construct()
    {
        $this->helper = new HelperController;
    }
    use WithPagination;
    public $paginationTheme = 'bootstrap';
    public $listeners = ['refreshDataProject' => '$refresh'];
    public $total_show = 10;
    public $cari;
    protected $listProject;
    public function render()
    {
        $this->listProject = Project::where(function($query){
            $query->where('nama_project', 'LIKE', '%' . $this->cari . '%')
            ->orWhere('alamat_project', 'LIKE', '%' . $this->cari . '%')
            ->orWhere('keterangan_project', 'LIKE', '%' . $this->cari . '%')
            ->orWhereHas('customer', function($query){
                $query->where('nama', 'LIKE', '%' . $this->cari . '%');
            });
        })->paginate($this->total_show);
        $data['listProject'] = $this->listProject;
        return view('livewire.form-pekerjaan.data', $data);
    }

    public function mount(){

    }
}
