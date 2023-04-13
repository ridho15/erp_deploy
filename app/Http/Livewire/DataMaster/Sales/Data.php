<?php

namespace App\Http\Livewire\DataMaster\Sales;

use App\Http\Controllers\HelperController;
use App\Models\Sales;
use Livewire\Component;
use Livewire\WithPagination;

class Data extends Component
{
    use WithPagination;
    public $paginationTheme = 'bootstrap';
    public $listeners = [
        'refreshSales' => '$refresh',
        'hapusSales'
    ];
    public $total_show = 10;
    public $cari;
    protected $listSales;
    public function render()
    {
        $this->listSales = Sales::where(function($query){
            $query->where('nama', 'LIKE', '%' . $this->cari . '%')
            ->orWhere('no_hp', 'LIKE', '%' . $this->cari . '%')
            ->orWhere('alamat', 'LIKE', '%' . $this->cari . '%')
            ->orWhere('nama_perusahaan', 'LIKE', '%' . $this->cari . '%');
        })->orderBy('created_at', 'DESC')->paginate($this->total_show);

        $data['listSales'] = $this->listSales;
        return view('livewire.data-master.sales.data', $data);
    }

    public function hapusSales($id){
        $sales = Sales::find($id);
        if(!$sales){
            $message = "Data sales tidak ditemukan";
            return session()->flash('fail', $message);
        }

        $sales->delete();
        $message = "Data sales berhasil dihapus";
        activity()->causedBy(HelperController::user())->log("Hapus data sales");
        return session()->flash('success', $message);
    }
}
