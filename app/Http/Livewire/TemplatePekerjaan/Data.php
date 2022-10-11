<?php

namespace App\Http\Livewire\TemplatePekerjaan;

use App\Models\TemplatePekerjaan;
use Livewire\Component;
use Livewire\WithPagination;

class Data extends Component
{
    use WithPagination;
    public $paginationTheme = 'bootstrap';
    public $listeners = ['hapusTemplatePekerjaan', 'refreshTemplatePekerjaan' => '$refresh'];
    public $total_show = 10;
    public $cari;
    protected $listTemplatePekerjaan;
    public $id_form_master;
    public function render()
    {
        $this->listTemplatePekerjaan = TemplatePekerjaan::where(function($query){
            $query->where('nama_pekerjaan', 'LIKE', '%' . $this->cari . '%')
            ->orWhere('keterangan', 'LIKE', '%' . $this->cari . '%');
        })->orWhere('id_form_master', $this->id_form_master)->paginate($this->total_show);
        $data['listTemplatePekerjaan'] = $this->listTemplatePekerjaan;
        return view('livewire.template-pekerjaan.data', $data);
    }

    public function mount($id_form_master = null){
        $this->id_form_master = $id_form_master;
    }

    public function hapusTemplatePekerjaan($id){
        $templatePekerjaan = TemplatePekerjaan::find($id);
        if(!$templatePekerjaan){
            $message = "Data tidak ditemukan !";
            return session()->flash('fail', $message);
        }

        $templatePekerjaan->delete();
        $message = "Data berhasil dihapus";
        $this->emit('finishRefreshData', 1, $message);
        return session()->flash('success', $message);
    }
}
