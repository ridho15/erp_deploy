<?php

namespace App\Http\Livewire\Laporan;

use App\Models\PreOrder;
use App\Models\SupplierOrder;
use Carbon\CarbonPeriod;
use Livewire\Component;

class GrafikPreOrder extends Component
{
    public $tanggal_awal;
    public $tanggal_akhir;
    protected $periode;
    public $listProfit = [];
    public $listTanggal = [];
    public function render()
    {
        $this->listTanggal = [];
        $this->listProfit = [];
        $this->periode = CarbonPeriod::create($this->tanggal_awal, $this->tanggal_akhir);
        foreach ($this->periode as $item) {
            $totalHargaSupplierOrder = SupplierOrder::whereDate('tanggal_order', $item->format('Y-m-d'))
            ->where('status_pembayaran', 2)
            ->sum('total_harga');

            $totalHargaPreOrder = PreOrder::whereDate('created_at', $item->format('Y-m-d'))
            ->get()->where('status_pembayaran', 2)->sum('total_bayar');

            $profit = $totalHargaPreOrder - $totalHargaSupplierOrder;
            array_push($this->listTanggal, $item->format('Y-m-d'));
            array_push($this->listProfit, $profit);
        }

        $this->dispatchBrowserEvent('contentChange');
        return view('livewire.laporan.grafik-pre-order');
    }

    public function mount(){
        $this->tanggal_awal = date('Y-m-d');
        $this->tanggal_akhir = date('Y-m-d');
    }
}
