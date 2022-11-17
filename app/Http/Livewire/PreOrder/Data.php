<?php

namespace App\Http\Livewire\PreOrder;

use App\Models\Customer;
use App\Models\PreOrder;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Data extends Component
{
    use WithPagination;
    public $paginationTheme = 'bootstrap';
    public $listeners = [
        'hapusPreOrder',
         'refreshPreOrder' => '$refresh',
         'clearFilter'
    ];
    public $total_show = 10;
    public $cari;
    protected $listPreOrder;
    public $selesai;
    public $belum_selesai;

    public $status_pekerjaan;
    public $status_pembayaran;
    public $tanggal_preorder;
    public $id_customer_filter;
    public $id_user_filter;
    public $listCustomer = [];
    public $listUser = [];
    public function render()
    {
        $this->listCustomer = Customer::get();
        $this->listUser = User::get();

        if ($this->cari) {
            $this->listPreOrder = PreOrder::where(function($query){
                $query->where('keterangan', 'LIKE', '%' . $this->cari . '%')
                ->orWhereHas('user', function($query){
                    $query->where('name', 'LIKE' , '%' . $this->cari . '%');
                })->orWhereHas('customer', function($query){
                    $query->where('nama','LIKE' ,'%' . $this->cari . '%');
                });
            })->orderBy('updated_at', 'DESC')->paginate($this->total_show);
        }elseif ($this->tanggal_preorder != null || $this->status_pekerjaan != null || $this->id_customer_filter != null || $this->id_user_filter != null) {
            $this->listPreOrder = PreOrder::where(function($query){
                $query->whereDate('created_at', date('Y-m-d', strtotime($this->tanggal_preorder)))
                ->orWhere('id_customer', $this->id_customer_filter)
                ->orWhere('id_user', $this->id_user_filter)
                ->orWhere(function($query){
                    if($this->status_pekerjaan == 0){ // Belum dikerjakan
                        $query->whereHas('quotation', function($query){
                            $query->whereHas('laporanPekerjaan', function($query){
                                $query->where('jam_mulai', null);
                            });
                        });
                    }elseif($this->status_pekerjaan == 1){ // sedang dikerjakan
                        $query->whereHas('quotation', function($query){
                            $query->whereHas('laporanPekerjaan', function($query){
                                $query->where('jam_mulai', '!=', null);
                            });
                        });
                    }elseif($this->status_pekerjaan == 2){ // Selesai
                        $query->whereHas('quotation', function($query){
                            $query->whereHas('laporanPekerjaan', function($query){
                                $query->where('jam_selesai', '!=', null)
                                ->where('signature', '!=', null);
                            });
                        });
                    }
                });
            })->orderBy('updated_at', 'DESC')->paginate($this->total_show);
        }else{
            $this->listPreOrder = PreOrder::orderBy('updated_at', 'DESC')->paginate($this->total_show);
        }

        $data['listPreOrder'] = $this->listPreOrder;

        $this->dispatchBrowserEvent('contentChange');
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

    public function clearFilter(){
        $this->status_pembayaran = null;
        $this->status_pekerjaan = null;
        $this->id_customer_filter = null;
        $this->id_user_filter = null;
        $this->tanggal_preorder = null;
    }
}
