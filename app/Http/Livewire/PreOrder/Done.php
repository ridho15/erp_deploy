<?php

namespace App\Http\Livewire\PreOrder;

use App\Models\Customer;
use App\Models\PreOrder;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Done extends Component
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
        $this->listPreOrder = PreOrder::where(function ($query) {
            $query->orWhereHas('quotation', function ($query) {
                $query->whereHas('laporanPekerjaan', function ($query) {
                    $query->where('signature', '!=', null)
                        ->where('jam_selesai', '!=', null);
                });
            })->orWhereHas('projectUnit', function ($query) {
                $query->whereHas('laporanPekerjaan', function ($query) {
                    $query->where('signature', '!=', null)
                        ->where('jam_selesai', '!=', null);
                });
            });
        })
            ->where(function ($query) {
                $query->where('keterangan', 'LIKE', '%' . $this->cari . '%')
                    ->orWhereHas('user', function ($query) {
                        $query->where('name', 'LIKE', '%' . $this->cari . '%');
                    })->orWhereHas('quotation', function ($query) {
                        $query->orWhereHas('projectUnit', function ($query) {
                            $query->whereHas('project', function ($query) {
                                $query->orWhere('id_customer', $this->id_customer_filter);
                            });
                        });
                    })->orWhereHas('projectUnit', function ($query) {
                        $query->orWhereHas('project', function ($query) {
                            $query->orWhere('id_customer', $this->id_customer_filter);
                        });
                    });
            })->where('status', 3)->orderBy('updated_at', 'DESC')->paginate($this->total_show);

        $data['listPreOrder'] = $this->listPreOrder;
        $this->dispatchBrowserEvent('contentChange');
        return view('livewire.pre-order.done', $data);
    }

    public function mount()
    {
        $this->listCustomer = Customer::get();
        $this->listUser = User::get();
    }
}
