<?php

namespace App\Http\Livewire\FormPekerjaan;

use App\Http\Controllers\HelperController;
use App\Models\Barang;
use App\Models\Project;
use App\Models\ProjectDetail;
use App\Models\ProjectDetailBarang as ModelsProjectDetailBarang;
use Livewire\Component;

class ProjectDetailBarang extends Component
{
    protected $helper;
    function __construct()
    {
        $this->helper = new HelperController;
    }
    public $listeners = [
        'getListProjectDetailBarang',
        'showHideTambahBarang',
        'simpanBarang',
        'changeBarang',
        'changeStatusBarang',
        'hapusBarangProject',
        'setProjectDetailBarang',
    ];
    public $id_project_detail_barang;
    public $id_project_detail;
    public $id_barang;
    public $status_barang;
    public $qty;
    public $listProjectDetailBarang;
    public $cari;
    public $tambahBarang = false;
    public $listBarang;
    public $listStatusBarang;
    public function render()
    {
        $this->listProjectDetailBarang = ModelsProjectDetailBarang::where(function($query){
            $query->whereHas('barang', function($query){
                $query->where('nama', 'LIKE', '%' . $this->cari . '%');
            })->orWhereHas('projectDetail', function($query){
                $query->where('nama_pekerjaan', 'LIKE', '%' . $this->cari . '%');
            });
        })
        ->where('id_project_detail', $this->id_project_detail)
        ->get();
        $this->listBarang = Barang::get();
        $this->listStatusBarang = $this->helper->getListStatusBarang();
        $this->dispatchBrowserEvent('contentChange');
        return view('livewire.form-pekerjaan.project-detail-barang');
    }

    public function mount(){

    }

    public function getListProjectDetailBarang($id_project_detail){
        $projectDetail = ProjectDetail::find($id_project_detail);
        if(!$projectDetail){
            $message = "Project detail tidak ditemukan";

            return session()->flash('fail', $message);
        }

        $this->id_project_detail = $id_project_detail;
    }

    public function showHideTambahBarang(){
        $this->tambahBarang = !$this->tambahBarang;
    }

    public function simpanBarang(){
        $this->validate([
            'id_project_detail' => 'required|numeric',
            'id_barang' => 'required|numeric',
            'status_barang' => 'required|numeric',
            'qty' => 'required|numeric',
        ], [
            'id_project_detail.required' => 'Project detail tidak valid !',
            'id_project_detail.numeric' => 'Project detail tidak valid !',
            'id_barang.required' => 'Barang belum dipilih !',
            'id_barang.numeric' => 'Barang tidak valid !',
            'status_barang.required' => 'Status Barang belum dipilih !',
            'status_barang.numeric' => 'Status Barang tidak valid !',
            'qty.required' => 'Quantity tidak boleh kosong',
            'qty.numeric' => 'Quantity tidak valid !'
        ]);

        // Check Project Detail
        $projectDetail = ProjectDetail::find($this->id_project_detail);
        if(!$projectDetail){
            $message = "Project detail tidak ditemukan";
            return session()->flash('fail', $message);
        }

        // Check Barang
        $barang = Barang::find($this->id_barang);
        if(!$barang){
            $message = "Barang tidak ditemukan !";
            return session()->flash('fail', $message);
        }

        ModelsProjectDetailBarang::updateOrCreate([
            'id' => $this->id_project_detail_barang
        ], [
            'id_project_detail' => $this->id_project_detail,
            'id_barang' => $this->id_barang,
            'status_barang' => $this->status_barang,
            'qty' => $this->qty
        ]);

        $this->updateProject();
        $message = "Berhasil menyimpan barang ke pekerjaan";
        activity()->causedBy(HelperController::user())->log("Menyimpan barang ke pekerjaan");
        $this->tambahBarang = false;
        $this->resetInputFields();
        return session()->flash('success', $message);
    }

    public function updateProject(){
        $project = Project::whereHas('projectDetail', function($query){
            $query->where('id', $this->id_project_detail);
        })->first();

        $total_barang = 0;
        $total_harga = 0;
        foreach ($project->projectDetail as $item) {
            foreach ($item->projectDetailBarang as $projectDetailBarang) {
                $total_harga += $projectDetailBarang->barang->harga * $projectDetailBarang->qty;
                $total_barang ++;
            }
        }

        $project->update([
            'total_barang' => $total_barang,
            'total_harga' => $total_harga
        ]);
        activity()->causedBy(HelperController::user())->log("Update data pekerjaan");
        $this->emit('refreshProject');
    }

    public function resetInputFields(){
        $this->id_project_detail_barang = null;
        $this->id_barang = null;
        $this->status_barang = null;
        $this->qty = null;
    }

    public function changeBarang($id_barang){
        $this->id_barang = $id_barang;
    }

    public function changeStatusBarang($status_barang){
        $this->status_barang = $status_barang;
    }

    public function hapusBarangProject($id){
        $projectDetailBarang = ModelsProjectDetailBarang::find($id);
        if(!$projectDetailBarang){
            $message = "Data Barang tidak ditemukan !";
            return session()->flash('fail', $message);
        }

        $projectDetailBarang->delete();
        $message = "Berhasil menghapus barang dari project";
        activity()->causedBy(HelperController::user())->log("Menghapus barang dari project");
        return session()->flash('success', $message);
    }

    public function setProjectDetailBarang($id){
        $this->tambahBarang = true;
        $projectDetailBarang = ModelsProjectDetailBarang::find($id);
        if(!$projectDetailBarang){
            $message = "Data tidak ditemukan !";
            return session()->flash('fail', $message);
        }

        $this->id_project_detail_barang = $projectDetailBarang->id;
        $this->id_barang = $projectDetailBarang->id_barang;
        $this->qty = $projectDetailBarang->qty;
        $this->status_barang = $projectDetailBarang->status_barang;
    }
}
