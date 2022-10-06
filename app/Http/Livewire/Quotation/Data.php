<?php

namespace App\Http\Livewire\Quotation;

use App\Models\Quotation;
use Livewire\Component;
use Livewire\WithPagination;

class Data extends Component
{
    use WithPagination;
    public $listeners = ['refreshQuotation' => '$refresh', 'hapusQuotation'];
    public $paginationTheme = 'bootstrap';
    public $total_show = 10;
    public $cari;
    protected $listQuotation = [];
    public function render()
    {
        $this->listQuotation = Quotation::where(function($query){
            $query->whereHas('project', function($query){
                $query->where('nama_project', 'LIKE', '%' . $this->cari . '%')
                ->orWhereHas('customer', function($query){
                    $query->where('nama','LIKE', '%' . $this->cari . '%');
                });
            })->orWhereHas('tipePembayaran', function($query){
                $query->where('nama_tipe', 'LIKE', '%' . $this->cari . '%');
            });
        })->paginate($this->total_show);
        $data['listQuotation'] = $this->listQuotation;
        return view('livewire.quotation.data', $data);
    }

    public function hapusQuotation($id){
        $quotation = Quotation::find($id);
        if(!$quotation){
            $mesasge = "Data quotaion tidak ditemukan !";

            return session()->flash('fail', $mesasge);
        }

        $quotation->delete();
        $mesasge = "Berhasil menghapus quotation";
        $this->emit('finishRefreshQuotation', 1, $mesasge);
        return session()->flash('success', $mesasge);
    }
}
