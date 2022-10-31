<?php

namespace App\Http\Livewire\Pekerjaan;

use App\Models\Pekerjaan;
use Livewire\Component;
use Livewire\WithPagination;

class Data extends Component
{
    use WithPagination;
    public $paginationTheme = 'bootstrap';
    public $listeners = ['refreshKondisi' => '$refresh', 'hapusKondisi'];
    protected $listKondisi;
    public $total_show = 10;
    public $cari;

    public function render()
    {
        $this->listKondisi = Pekerjaan::where(function ($query) {
            $query->where('kode', 'LIKE', '%'.$this->cari.'%')
            ->orWhere('keterangan', 'LIKE', '%'.$this->cari.'%');
        })->paginate($this->total_show);
        $data['listKondisi'] = $this->listKondisi;

        return view('livewire.pekerjaan.data', $data);
    }

    public function mount()
    {
    }

    public function hapusKondisi($id)
    {
        $kondisi = Pekerjaan::find($id);
        if (!$kondisi) {
            $message = 'Data Kondisi Tidak ditemukan';

            return session()->flash('fail', $message);
        }

        $kondisi->delete();
        $message = 'Berhasil menghapus data pekerjaan';
        $this->emit('finishRefreshKondisi', 1, $message);

        return session()->flash('success', $message);
    }
}
