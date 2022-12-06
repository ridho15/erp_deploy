<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\PreOrder;
use Livewire\Component;

class AccountReceivable extends Component
{
    public $listPreOrder;
    public $totalPreOrder;
    public function render()
    {
        $this->listPreOrder = PreOrder::whereHas('quotation', function($query){
            $query->whereHas('laporanPekerjaan', function($query){
                $query->where('signature', '!=', null)
                ->where('jam_selesai', '!=', null);
            });
        })->where('status', '!=', 3)->orderBy('updated_at', 'DESC')->take(10)->get()->where('status_pembayaran', '!=', 2);

        $this->totalPreOrder = PreOrder::whereHas('quotation', function($query){
            $query->whereHas('laporanPekerjaan', function($query){
                $query->where('signature', '!=', null)
                ->where('jam_selesai', '!=', null);
            });
        })->where('status', '!=', 3)->orderBy('updated_at', 'DESC')->count();
        return view('livewire.dashboard.account-receivable');
    }
}
