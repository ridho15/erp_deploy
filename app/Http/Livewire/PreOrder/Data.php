<?php

namespace App\Http\Livewire\PreOrder;

use App\Http\Controllers\HelperController;
use App\Models\Customer;
use App\Models\PreOrder;
use App\Models\Quotation;
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
        if ($this->cari) {
            $this->listPreOrder = PreOrder::where(function($query){
                $query->orWhereHas('quotation', function($query){
                    $query->whereHas('laporanPekerjaan', function($query){
                        $query->where('signature', null)
                        ->orWhere('jam_selesai', null);
                    });
                })->orWhereHas('projectUnit', function($query){
                    $query->whereHas('laporanPekerjaan', function($query){
                        $query->where('signature', null)
                        ->orWhere('jam_selesai', null);
                    });
                });
            })
            ->where(function($query){
                $query->where('keterangan', 'LIKE', '%' . $this->cari . '%')
                ->orWhere('id_quotation', 'LIKE', '%' . $this->cari . '%')
                ->orWhere('no_ref', 'LIKE', '%' . $this->cari . '%')
                ->orWhereHas('quotation', function($query){
                    $query->where('nomor_quotation', 'LIKE', '%' . $this->cari . '%')
                    ->orWhereHas('projectUnit', function($query){
                        $query->whereHas('project', function($query){
                            $query->where('nama', 'LIKE', '%' . $this->cari . '%');
                        });
                    });
                })->orWherehas('projectUnit', function($query){
                    $query->whereHas('project', function($query){
                        $query->where('nama', 'LIKE', '%' . $this->cari . '%');
                    });
                })
                ->orWhereHas('user', function($query){
                    $query->where('name', 'LIKE' , '%' . $this->cari . '%');
                });
            })->orderBy('updated_at', 'DESC')->withTrashed()->paginate($this->total_show);
        }elseif ($this->tanggal_preorder != null || $this->status_pekerjaan != null || $this->id_customer_filter != null || $this->id_user_filter != null) {
            $this->listPreOrder = PreOrder::whereHas('quotation', function($query){
                $query->whereHas('laporanPekerjaan', function($query){
                    $query->where('signature', null)
                    ->orWhere('jam_selesai', null);
                });
            })->where(function($query){
                $query->whereDate('created_at', date('Y-m-d', strtotime($this->tanggal_preorder)))
                ->orWhere('id_user', $this->id_user_filter)
                ->orWhereHas('projectUnit', function($query){
                    $query->whereHas('project', function($query){
                        $query->orWhere('id_customer', $this->id_customer_filter);
                    });
                });
            })->orderBy('updated_at', 'DESC')->withTrashed()->paginate($this->total_show);
        }else{
            // $this->listPreOrder = PreOrder::orWhereHas('quotation', function($query){
            //     $query->whereHas('laporanPekerjaan', function($query){
            //         $query->where('signature', null)
            //         ->orWhere('jam_selesai', null);
            //     })->doesntHave('laporanPekerjaan', 'or');
            // })->orderBy('updated_at', 'DESC')->paginate($this->total_show);

            $this->listPreOrder = PreOrder::orderBy('updated_at', 'DESC')->withTrashed()->paginate($this->total_show);
        }

        $data['listPreOrder'] = $this->listPreOrder;
        $this->dispatchBrowserEvent('contentChange');
        return view('livewire.pre-order.data', $data);
    }

    public function mount(){
        $this->listCustomer = Customer::get();
        $this->listUser = User::get();
    }

    public function hapusPreOrder($id){
        $preOrder = PreOrder::find($id);
        if(!$preOrder){
            $message = "Data Pre Order tidak ditemukan !";
            $this->emit('finishRefreshData', 0, $message);
            return session()->flash('fail', $message);
        }

        if($preOrder->id_quotation != null){
            $quotation = Quotation::find($preOrder->id_quotation);
            if($quotation){
                $quotation->update([
                    'status_like' => 0
                ]);
            }
        }elseif($preOrder->id_project_unit && $preOrder->projectUnit->quotation){
            $preOrder->projectUnit->quotation->update([
                'status_like' => 0
            ]);
        }

        $preOrder->delete();
        $message = "Berhasil menghapus data pre order";
        activity()->causedBy(HelperController::user())->log("Menghapus data pre order");
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
