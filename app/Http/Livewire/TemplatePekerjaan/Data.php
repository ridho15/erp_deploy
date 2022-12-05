<?php

namespace App\Http\Livewire\TemplatePekerjaan;

use App\Http\Controllers\HelperController;
use App\Models\FormMaster;
use App\Models\TemplatePekerjaan;
use App\Models\TemplatePekerjaanDetail;
use Livewire\Component;
use Livewire\WithPagination;

class Data extends Component
{
    use WithPagination;
    public $paginationTheme = 'bootstrap';
    public $listeners = [
        'hapusTemplatePekerjaan',
        'refreshTemplatePekerjaan' => '$refresh',
        'hapusTemplatePekerjaanDetail',
        'hapusTemplatePekerjaanDetailParent'
    ];
    public $total_show = 10;
    public $cari;
    public $listTemplatePekerjaan;
    public $id_form_master;
    public $listData = [];

    public function render()
    {
        $this->listTemplatePekerjaan = TemplatePekerjaan::where('id_form_master', $this->id_form_master)->where(function ($query) {
            $query->where('nama_pekerjaan', 'LIKE', '%'.$this->cari.'%')
            ->orWhere('keterangan', 'LIKE', '%'.$this->cari.'%');
        })->get();
        $data['periode'] = FormMaster::find($this->id_form_master)->periode;

        return view('livewire.template-pekerjaan.data', $data);
    }

    public function mount($id_form_master = null)
    {
        $this->id_form_master = $id_form_master;
    }

    public function hapusTemplatePekerjaan($id)
    {
        $templatePekerjaan = TemplatePekerjaan::find($id);
        if (!$templatePekerjaan) {
            $message = 'Data tidak ditemukan !';

            return session()->flash('fail', $message);
        }

        $templatePekerjaan->delete();
        $message = 'Data berhasil dihapus';
        activity()->causedBy(HelperController::user())->log("Berhasil menghapus template pekerjaan");
        $this->emit('finishRefreshData', 1, $message);

        return session()->flash('success', $message);
    }

    public function hapusTemplatePekerjaanDetail($id)
    {
        $templatePekerjaan = TemplatePekerjaanDetail::find($id);
        if (!$templatePekerjaan) {
            $message = 'Data tidak ditemukan !';

            return session()->flash('fail', $message);
        }

        $templatePekerjaan->delete();
        $message = 'Data berhasil dihapus';
        activity()->causedBy(HelperController::user())->log("Berhasil menghapus template pekerjaan detail");
        $this->emit('finishRefreshData', 1, $message);

        return session()->flash('success', $message);
    }

    public function hapusTemplatePekerjaanDetailParent($id)
    {
        $templatePekerjaan = TemplatePekerjaanDetail::find($id);
        if (!$templatePekerjaan) {
            $message = 'Data tidak ditemukan !';

            return session()->flash('fail', $message);
        }

        $templatePekerjaan->delete();
        $message = 'Data berhasil dihapus';
        activity()->causedBy(HelperController::user())->log("Berhasil menghapus template pekerjaan detail");
        $this->emit('finishRefreshData', 1, $message);

        return session()->flash('success', $message);
    }
}
