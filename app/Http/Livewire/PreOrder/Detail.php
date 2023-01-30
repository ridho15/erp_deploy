<?php

namespace App\Http\Livewire\PreOrder;

use App\Http\Controllers\HelperController;
use App\Models\Barang;
use App\Models\BarangStockLog;
use App\Models\Customer;
use App\Models\LaporanPekerjaan;
use App\Models\Merk;
use App\Models\MetodePembayaran;
use App\Models\PreOrder;
use App\Models\PreOrderLog;
use App\Models\Project;
use App\Models\ProjectV2;
use App\Models\TipePembayaran;
use Livewire\Component;
use Livewire\WithFileUploads;

class Detail extends Component
{
    use WithFileUploads;
    public $listeners = [
        'changeStatusPreOrder',
        'preOrderSelesai',
        'refreshPreOrder' => '$refresh',
        'changeShowFormCustomer',
        'changeCustomer',
        'simpanUpdateCustomer',
        'changeMerk',
        'simpanUpdatePembayaran'
    ];
    public $id_pre_order;
    public $preOrder;
    public $laporanPekerjaan;
    public $total_bayar = 0;
    public $isControl = false;
    public $showFormCustomer = false;
    public $showFormPembayaran = false;
    public $id_customer;
    public $id_project;
    public $id_merk;
    public $id_metode_pembayaran;
    public $id_tipe_pembayaran;
    public $keterangan;
    public $file;
    public $listCustomer = [];
    public $listMerk = [];
    public $listMetodePembayaran = [];
    public $listTipePembayaran = [];
    public $namaProject;
    public $nomor_lift;
    public $merk;
    public function render()
    {
        $this->preOrder = PreOrder::find($this->id_pre_order);
        if ($this->preOrder && $this->preOrder->quotation && $this->preOrder->quotation->laporanPekerjaan && ($this->preOrder->quotation->laporanPekerjaan->signature != null || $this->preOrder->quotation->laporanPekerjaan->jam_selesai != null)) {
            $this->isControl = true;
        }
        $this->dispatchBrowserEvent('contentChange');
        return view('livewire.pre-order.detail');
    }

    public function mount($id_pre_order)
    {
        $this->id_pre_order = $id_pre_order;
        $preOrder = PreOrder::find($this->id_pre_order);
        $this->id_metode_pembayaran = $preOrder->id_metode_pembayaran;
        $this->id_tipe_pembayaran = $preOrder->id_tipe_pembayaran;
        $this->keterangan = $preOrder->keterangan;
        $this->id_customer = $preOrder->id_customer;
        foreach ($preOrder->preOrderBayar as $item) {
            $this->total_bayar += $item->pembayaran_sekarang;
        }
        $this->listCustomer = Customer::get();
        $project = ProjectV2::find($this->id_customer);
        if ($project) {
            $this->id_project = $project->id;
            $this->namaProject = $project->nama;
        }

        if(isset($preOrder->quotation->laporanPekerjaan)){
            $this->nomor_lift = $preOrder->quotation->laporanPekerjaan->nomor_lift;
            $this->id_merk = $preOrder->quotation->laporanPekerjaan->id_merk;
        }else{
            $this->nomor_lift = 'Belum ada pekerjaan';
        }
        $this->listMerk = Merk::get();
        $this->listMetodePembayaran = MetodePembayaran::get();
        $this->listTipePembayaran = TipePembayaran::get();
    }

    public function changeStatusPreOrder($id, $status)
    {
        $preOrder = PreOrder::find($id);
        if (!$preOrder) {
            $message = "Data Pre Order tidak ditemukan !";
            $this->emit('finishRefreshData', 0, $message);
            return session()->flash('fail', $message);
        }

        $preOrder->update([
            'status' => $status
        ]);

        PreOrderLog::create([
            'id_pre_order' => $preOrder->id,
            'tanggal' => now(),
            'status' => $status
        ]);

        $message = "Pre Order berhasil di update";
        activity()->causedBy(HelperController::user())->log("CHange status pre order");
        $this->emit('refreshPreOrderLog');
        $this->emit('finishRefreshData', 1, $message);
        return session()->flash('success', $message);
    }

    public function preOrderSelesai($id, $status)
    {
        $preOrder = PreOrder::find($id);
        if (!$preOrder) {
            $message = "Data Pre Order tidak ditemukan !";
            $this->emit('finishRefreshData', 0, $message);
            return session()->flash('fail', $message);
        }

        foreach ($preOrder->preOrderDetail as $item) {
            $barang = Barang::find($item->id_barang);
            if (!$barang) {
                $message = "Data barang tidak ditemukan !";
                $this->emit('finishRefreshData', 0, $message);
                return session()->flash('fail', $message);
            }

            if ($preOrder->id_quotation == null) {
                $barang->barangStockChange($item->qty, 4);
            }
        }

        $preOrder->update([
            'status' => 3
        ]);

        PreOrderLog::create([
            'id_pre_order' => $preOrder->id,
            'tanggal' => now(),
            'status' => 3
        ]);

        $message = "Berhasil menyimpan data";
        activity()->causedBy(HelperController::user())->log("Change status pre order ke selesai");
        $this->emit('refreshPreOrderLog');
        $this->emit('refreshPreOrderDetail');
        $this->emit('finishRefreshData', 1, $message);
        return session()->flash('success', $message);
    }

    public function changeShowFormCustomer()
    {
        $this->showFormCustomer = !$this->showFormCustomer;
    }

    public function changeShowFormPembayaran()
    {
        $this->showFormPembayaran = !$this->showFormPembayaran;
    }

    public function changeCustomer($id_customer)
    {
        $this->id_customer = $id_customer;
        $project = ProjectV2::find($this->id_customer);
        if ($project) {
            $this->namaProject = $project->nama;
        }else{
            $this->namaProject = 'Project tidak ditemukan';
        }
    }

    public function simpanUpdateCustomer(){
        $this->validate([
            'id_customer' => 'required|numeric',
            'id_project' => 'required|numeric'
        ], [
            'id_customer.required' => 'Customer belum dipilih',
            'id_project.required' => 'Project tidak ditemukan. customer belum memiliki project'
        ]);


        $preOrder = PreOrder::find($this->id_pre_order);
        $preOrder->update([
            'id_customer' => $this->id_customer
        ]);

        activity()->causedBy(HelperController::user())->log("Mengupdate data PO");

        if(isset($preOrder->quotation->laporanPekerjaan)){
            $laporanPekerjaan = $preOrder->quotation->laporanPekerjaan;
            $laporanPekerjaan->update([
                'nomor_lift' => $this->nomor_lift,
                'id_merk' => $this->id_merk
            ]);

            activity()->causedBy(HelperController::user())->log('Mengupdate data laporan pekerjaan');
        }else{
            return session()->flash('fail', 'Data laporan pekerjaan tidak ditemukan');
        }

        $this->showFormCustomer = false;
        $message = 'Data berhasil di update';
        $this->emit('finishSimpanData', 1, $message);
        return session()->flash('success', $message);
    }

    public function changeMerk($id_merk){
        $this->id_merk = $id_merk;
    }

    public function simpanUpdatePembayaran(){
        $this->validate([
            'id_metode_pembayaran' => 'required|numeric',
            'id_tipe_pembayaran' => 'required|numeric'
        ]);

        if($this->file){
            $path = $this->file->store('public/pre-order');
            $path = str_replace('public', '', $path);
            $data['file'] = $path;
        }
        $data['keterangan'] = $this->keterangan;
        $data['id_tipe_pembayaran'] = $this->id_tipe_pembayaran;
        $data['id_metode_pembayaran'] = $this->id_metode_pembayaran;
        $preOrder = PreOrder::find($this->id_pre_order);
        $preOrder->update($data);

        $this->showFormPembayaran = false;
        $message = 'Berhasil mengupdate pembayaran Pada PO';
        activity()->causedBy(HelperController::user())->log("Mengupdate pembayaran pada PO");
        $this->emit('finishSimpanData', 1, $message);
        return session()->flash('success', $message);
    }
}
