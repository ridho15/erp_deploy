<?php

namespace App\Http\Livewire\FormPekerjaan;

use App\Models\Kondisi;
use App\Models\ProjectDetail;
use App\Models\ProjectDetailSub;
use Livewire\Component;

class FormUraianPekerjaan extends Component
{
    public $listeners = [
        'setProjectDetailId',
        'simpanProjectDetailSub',
        'setDataProjectDetailSub',
        'changeKondisi1Bulan',
        'changeKondisi2Bulan',
        'changeKondisi3Bulan',
        'changeKondisi6Bulan',
        'changeKondisi1Tahun',
    ];
    public $id_project_detail_sub;
    public $id_project_detail;
    public $nama_sub_pekerjaan;
    public $kondisi_1_bulan;
    public $kondisi_2_bulan;
    public $kondisi_3_bulan;
    public $kondisi_6_bulan;
    public $kondisi_1_tahun;
    public $keterangan;
    public $listProjectDetail = [];
    public $listKondisi = [];
    public $projectDetail;

    public function render()
    {
        $this->listKondisi = Kondisi::get();
        $this->dispatchBrowserEvent('contentChangeFormUraian');
        return view('livewire.form-pekerjaan.form-uraian-pekerjaan');
    }

    public function mount(){

    }

    public function setProjectDetailId($id_project_detail){
        $this->id_project_detail = $id_project_detail;
        $this->projectDetail = ProjectDetail::find($this->id_project_detail);
        $this->listProjectDetail = ProjectDetail::where('id_project', $this->projectDetail->id_project)->get();
    }

    public function simpanProjectDetailSub(){
        $this->validate([
            'id_project_detail' => 'required|numeric',
            'nama_sub_pekerjaan' => 'required|string',
            'kondisi_1_bulan' => 'nullable|numeric',
            'kondisi_2_bulan' => 'nullable|numeric',
            'kondisi_3_bulan' => 'nullable|numeric',
            'kondisi_6_bulan' => 'nullable|numeric',
            'kondisi_1_tahun' => 'nullable|numeric',
            'keterangan' => 'nullable|string'
        ],[
            'id_project_detail.required' => 'Induk Pekerjaan tidak ditemukan',
            'id_project_detail.numeric' => 'Induk Pekerjaan tidak valid !',
            'nama_sub_pekerjaan.required' => 'Nama pekerjaan tidak boleh kosong',
            'nama_sub_pekerjaan.string' => 'Nama pekerjaan tidak valid !',
            'kondisi_1_bulan.numeric' => 'Kondisi Pekerjaan tidak valid !',
            'kondisi_2_bulan.numeric' => 'Kondisi Pekerjaan tidak valid !',
            'kondisi_3_bulan.numeric' => 'Kondisi Pekerjaan tidak valid !',
            'kondisi_6_bulan.numeric' => 'Kondisi Pekerjaan tidak valid !',
            'kondisi_1_tahun.numeric' => 'Kondisi Pekerjaan tidak valid !',
            'keterangan.string' => 'Keterangan tidak valid !'
        ]);

        $projectDetail = ProjectDetail::find($this->id_project_detail);
        if(!$projectDetail){
            $message = "Induk Pekerjaan tidak ditemukan";
            return session()->flash('fail', $message);
        }

        ProjectDetailSub::updateOrCreate([
            'id' => $this->id_project_detail_sub
        ], [
            'id_project_detail' => $this->id_project_detail,
            'nama_sub_pekerjaan' => $this->nama_sub_pekerjaan,
            'kondisi_1_bulan' => $this->kondisi_1_bulan,
            'kondisi_2_bulan' => $this->kondisi_2_bulan,
            'kondisi_3_bulan' => $this->kondisi_3_bulan,
            'kondisi_6_bulan' => $this->kondisi_6_bulan,
            'kondisi_1_tahun' => $this->kondisi_1_tahun,
            'keterangan' => $this->keterangan
        ]);

        $message = "Berhasil menyimpan data pekerjaan";
        $this->resetInputFields();
        $this->emit('refreshProjectDetailSub');
        $this->emit('finishSimpanData', 1, $message);
        return session()->flash('success', $message);
    }

    public function resetInputFields(){
        $this->id_project_detail_sub = null;
        $this->nama_sub_pekerjaan = null;
        $this->kondisi_1_bulan = null;
        $this->kondisi_2_bulan = null;
        $this->kondisi_3_bulan = null;
        $this->kondisi_6_bulan = null;
        $this->kondisi_1_tahun = null;
        $this->keterangan = null;
    }

    public function setDataProjectDetailSub($id){
        $projectDetailSub = ProjectDetailSub::find($id);
        if(!$projectDetailSub){
            $message = "Detail Uraian Pekerjaan tidak ditemukan";
            return session()->flash('fail', $message);
        }

        $this->id_project_detail_sub = $projectDetailSub->id;
        $this->id_project_detail = $projectDetailSub->id_project_detail;
        $this->nama_sub_pekerjaan = $projectDetailSub->nama_sub_pekerjaan;
        $this->kondisi_1_bulan = $projectDetailSub->kondisi_1_bulan;
        $this->kondisi_2_bulan = $projectDetailSub->kondisi_2_bulan;
        $this->kondisi_3_bulan = $projectDetailSub->kondisi_3_bulan;
        $this->kondisi_6_bulan = $projectDetailSub->kondisi_6_bulan;
        $this->kondisi_1_tahun = $projectDetailSub->kondisi_1_tahun;
        $this->keterangan = $projectDetailSub->keterangan;
    }

    public function changeKondisi1Bulan($kondisi_1_bulan){
        $this->kondisi_1_bulan = $kondisi_1_bulan;
    }
    public function changeKondisi2Bulan($kondisi_2_bulan){
        $this->kondisi_2_bulan = $kondisi_2_bulan;
    }
    public function changeKondisi3Bulan($kondisi_3_bulan){
        $this->kondisi_3_bulan = $kondisi_3_bulan;
    }
    public function changeKondisi6Bulan($kondisi_6_bulan){
        $this->kondisi_6_bulan = $kondisi_6_bulan;
    }
    public function changeKondisi1Tahun($kondisi_1_tahun){
        $this->kondisi_1_tahun = $kondisi_1_tahun;
    }
}
