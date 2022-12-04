<?php

namespace App\Http\Livewire\Laporan;

use App\Models\BarangStockLog;
use App\Models\QuotationDetail;
use Carbon\CarbonPeriod;
use Livewire\Component;

class GrafikPenjualan extends Component
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
            $barangStockLog = BarangStockLog::where('id_tipe_perubahan_stock', 4)
            ->whereDate('tanggal_perubahan', $item->format('Y-m-d'))
            ->get();
            $total_profit = 0;
            foreach ($barangStockLog as $value) {
                $quotationDetail = QuotationDetail::where('id_quotation', $value->id_quotation)
                ->where('id_barang', $value->id_barang)
                ->where('qty', $value->perubahan)->first();
                $profit = 0;
                if($quotationDetail){
                    $profit = $quotationDetail->harga - $quotationDetail->barang->harga_modal;
                }

                $total_profit += $profit;
            }
            array_push($this->listTanggal, $item->format('Y-m-d'));
            array_push($this->listProfit, $total_profit);
            // array_push($this->listData, collect([
            //     'tanggal' => $item->format('Y-m-d'),
            //     'profit' => $total_profit
            // ]));
        }

        $this->dispatchBrowserEvent('contentChange');

        return view('livewire.laporan.grafik-penjualan');
    }

    public function mount(){
        $this->tanggal_awal = date('Y-m-d');
        $this->tanggal_akhir = date('Y-m-d');
    }
}
