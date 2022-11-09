<?php

namespace App\Http\Livewire\PreOrder;

use App\Models\PreOrder;
use Livewire\Component;
use Livewire\WithPagination;

class Data extends Component
{
    use WithPagination;
    public $paginationTheme = 'bootstrap';
    public $listeners = ['hapusPreOrder', 'refreshPreOrder' => '$refresh'];
    public $total_show = 10;
    public $cari;
    protected $listPreOrder;
    public $selesai;
    public $belum_selesai;
    public function render()
    {
        $this->listPreOrder = PreOrder::where(function($query){
            $query->where('keterangan', 'LIKE', '%' . $this->cari . '%')
            ->orWhereHas('user', function($query){
                $query->where('name', 'LIKE' , '%' . $this->cari . '%');
            })->orWhereHas('customer', function($query){
                $query->where('nama','LIKE' ,'%' . $this->cari . '%');
            });
        })->where(function($query){
            if ($this->selesai) {
                $query->where('status', 3);
            }

            if($this->belum_selesai){
                $query->orWhere('status', '!=', 3);
            }
        })->paginate($this->total_show);
        $data['listPreOrder'] = $this->listPreOrder;
        return view('livewire.pre-order.data', $data);
    }

    public function mount(){

    }

    public function hapusPreOrder($id){
        $preOrder = PreOrder::find($id);
        if(!$preOrder){
            $message = "Data Pre Order tidak ditemukan !";
            $this->emit('finishRefreshData', 0, $message);
            return session()->flash('fail', $message);
        }

        $preOrder->delete();
        $message = "Berhasil menghapus data pre order";
        $this->emit('finishRefreshData', 1, $message);
        return session()->flash('success', $message);
    }
}
