<?php

namespace App\Http\Livewire\PreOrder;

use App\Http\Controllers\HelperController;
use App\Models\Barang;
use App\Models\BarangStockLog;
use App\Models\PreOrder;
use App\Models\PreOrderBayar;
use App\Models\PreOrderLog;
use Livewire\Component;

class Pembayaran extends Component
{
    public $listeners = [
        'simpanPreOrderBayar',
        'pembayaranLunas',
        'refreshPreOrderPembayaran' => '$refresh'
    ];
    public $id_pre_order;
    public $preOrder;
    public $listPreOrderBayar;
    public $pembayaran_sekarang = 0;
    public $sudah_bayar;
    public $sisa_bayar;
    public function render()
    {
        $this->listPreOrderBayar = PreOrderBayar::where('id_pre_order', $this->id_pre_order)
            ->orderBy('updated_at', 'DESC')
            ->get();
        $total_bayar = 0;
        foreach ($this->listPreOrderBayar as $item) {
            $total_bayar += $item->pembayaran_sekarang;
        }
        $this->sudah_bayar = $total_bayar;
        $this->sisa_bayar = $this->preOrder->total_bayar - $this->sudah_bayar;
        if ($this->pembayaran_sekarang == null || $this->pembayaran_sekarang == 0) {
            $this->pembayaran_sekarang = $this->sisa_bayar;
        }
        $this->dispatchBrowserEvent('contentChange');
        return view('livewire.pre-order.pembayaran');
    }

    public function mount($id_pre_order)
    {
        $this->id_pre_order = $id_pre_order;
        $this->preOrder = PreOrder::find($this->id_pre_order);
    }

    public function simpanPreOrderBayar()
    {
        $this->validate([
            'pembayaran_sekarang' => 'required|numeric'
        ], [
            'pembayaran_sekarang.required' => 'Jumlah bayar tidak boleh kosong',
            'pembayaran_sekarang.numeric' => 'Jumlah bayar tidak valid !'
        ]);

        $preOrderBayar = PreOrderBayar::where('id_pre_order', $this->id_pre_order)->get();
        $total_bayar = 0;
        foreach ($preOrderBayar as $item) {
            $total_bayar += $item->pembayaran_sekarang;
        }

        $this->sudah_bayar = $total_bayar;
        if ($this->preOrder->total_bayar < ($this->sudah_bayar + $this->pembayaran_sekarang)) {
            $message = 'Jumlah yang di bayarkan melebihi total pembayaran pre order';
            return session()->flash('fail', $message);
        }
        PreOrderBayar::create([
            'id_pre_order' => $this->id_pre_order,
            'total_bayar_sebelumnya' => $this->sudah_bayar,
            'pembayaran_sekarang' => $this->pembayaran_sekarang
        ]);

        foreach ($this->preOrder->preOrderDetail as $preOrderDetail) {
            if ($preOrderDetail->status == 0) {
                $preOrderDetail->update([
                    'status' => 1
                ]);

                // $barang = Barang::find($preOrderDetail->id_barang);
                // BarangStockLog::create([
                //     'id_barang' => $preOrderDetail->id_barang,
                //     'stock_awal' => $barang->stock + $preOrderDetail->qty,
                //     'perubahan' => $preOrderDetail->qty,
                //     'tanggal_perubahan' => now(),
                //     'id_tipe_perubahan_stock' => 4,
                //     'id_user' => session()->get('id_user'),
                // ]);

                // if($this->preOrder->quotation && $this->preOrder->quotation->laporanPekerjaan && $this->preOrder->quotation->laporanPekerjaan->laporanPekerjaanBarang->where('id_barang', $preOrderDetail->id_barang)->first()){
                //     $laporanPekerjaanBarang = $this->preOrder->quotation->laporanPekerjaan->laporanPekerjaanBarang->where('id_barang', $preOrderDetail->id_barang)->first();
                //     $laporanPekerjaanBarang->update([
                //         'status' => 4
                //     ]);
                // }
            }
        }

        if ($this->preOrder->total_bayar == $this->preOrder->sudah_bayar) {
            $this->preOrder->update([
                'status' => 3
            ]);

            PreOrderLog::create([
                'id_pre_order' => $this->preOrder->id,
                'tanggal' => now(),
                'status' => 3
            ]);
        } elseif ($this->preOrder->sudah_bayar > 0) {
            $this->preOrder->update([
                'status' => 2
            ]);

            PreOrderLog::create([
                'id_pre_order' => $this->preOrder->id,
                'tanggal' => now(),
                'status' => 2
            ]);
        }

        if ($this->preOrder->status == 3) {
            foreach ($this->preOrder->preOrderDetail as $item) {
                $item->barang->barangStockChange($item->qty, 4);

                if ($this->preOrder->id_quotation != null && $this->preOrder->quotation->laporanPekerjaan && $this->preOrder->quotation->laporanPekerjaan->laporanPekerjaanBarang->where('id_barang', $preOrderDetail->id_barang)->first()) {
                    $laporanPekerjaanBarang = $this->preOrder->quotation->laporanPekerjaan->laporanPekerjaanBarang->where('id_barang', $preOrderDetail->id_barang);
                    foreach($laporanPekerjaanBarang as $item_2){
                        $item_2->update([
                            'status' => 4
                        ]);
                    }
                }elseif($this->preOrder->id_project_unit != null && $this->preOrder->projectUnit->laporanPekerjaan){
                    $laporanPekerjaanBarang = $this->preOrder->projectUnit->laporanPekerjaan->laporanPekerjaanBarang->where('id_barang', $preOrderDetail->id_barang);
                    foreach($laporanPekerjaanBarang as $item_2){
                        $item_2->update([
                            'status' => 4
                        ]);
                    }
                }
            }
        }

        $message = "Berhasil melakukan pembayaran";
        activity()->causedBy(HelperController::user())->log("Melakukan pembayaran Pre Order");
        $this->pembayaran_sekarang = 0;
        $this->emit('refreshPreOrder');
        $this->emit('finishSimpanData', 1, $message);
        return session()->flash('success', $message);
    }

    public function pembayaranLunas()
    {
        $this->pembayaran_sekarang = $this->sisa_bayar;
        $this->simpanPreOrderBayar();
    }
}
