<?php

namespace App\Http\Livewire\Invoice;

use App\Models\Customer;
use App\Models\PreOrder;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class AccountReceivable extends Component
{
    use WithPagination;
    public $paginationTheme = 'bootstrap';
    public $cari;
    public $total_show;

    public $status_pekerjaan;
    public $status_pembayaran;
    public $tanggal;
    public $id_customer_filter;
    public $id_user_filter;
    public $listCustomer = [];
    public $listUser = [];

    protected $listPreOrder;

    public function render()
    {
        $this->listCustomer = Customer::get();
        $this->listUser = User::get();
        if($this->tanggal != null || $this->id_customer_filter != null || $this->id_user_filter != null || $this->status_pekerjaan != null || $this->status_pembayaran != null){
            $this->listPreOrder = PreOrder::where(function($query){
                $query->whereDate('created_at', date('Y-m-d', strtotime($this->tanggal)))
                ->orWhere('id_customer', $this->id_customer_filter)
                ->orWhere('id_user', $this->id_user_filter);
            })->whereHas('quotation', function($query){
                $query->whereHas('laporanPekerjaan', function($query){
                    $query->where('signature', '!=', null)
                    ->where('jam_selesai', '!=', null);
                });
            })->where('status', '!=', 3)->orderBy('updated_at', 'DESC')->paginate($this->total_show);
        }else{
            $this->listPreOrder = PreOrder::whereHas('quotation', function($query){
                $query->whereHas('laporanPekerjaan', function($query){
                    $query->where('signature', '!=', null)
                    ->where('jam_selesai', '!=', null);
                });
            })->where(function($query){
                $query->where('keterangan', 'LIKE', '%' . $this->cari . '%')
                ->orWhereHas('user', function($query){
                    $query->where('name', 'LIKE' , '%' . $this->cari . '%');
                })->orWhereHas('customer', function($query){
                    $query->where('nama','LIKE' ,'%' . $this->cari . '%');
                });
            })->where('status', '!=', 3)->orderBy('updated_at', 'DESC')->paginate($this->total_show);
        }

        $data['listPreOrder'] = $this->listPreOrder;
        $this->dispatchBrowserEvent('contentChange');
        return view('livewire.invoice.account-receivable', $data);
    }

    public function mount(){

    }

    public function clearFilter(){
        $this->status_pembayaran = null;
        $this->status_pekerjaan = null;
        $this->id_customer_filter = null;
        $this->id_user_filter = null;
        $this->tanggal = null;
    }
}
