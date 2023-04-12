<?php

namespace App\Http\Livewire\ManagementTugas;

use App\Http\Controllers\HelperController;
use App\Models\Customer;
use App\Models\FormMaster;
use App\Models\LaporanPekerjaan;
use App\Models\LaporanPekerjaanBarang;
use App\Models\LaporanPekerjaanUser;
use App\Models\Merk;
use App\Models\PreOrder;
use App\Models\ProjectUnit;
use App\Models\ProjectV2;
use App\Models\Quotation;
use App\Models\User;
use Livewire\Component;

class Form extends Component
{
    public $listeners = [
        'simpanManagementTugas',
        'setDataManagementTugas',
        'changeCustomer',
        'changeQuotation',
        'changePurchaseOrder',
        'changeProjectUnit'
    ];
    public $id_laporan_pekerjaan;
    public $id_customer;
    public $id_project;
    public $id_merk;
    public $id_form_master;
    public $nomor_lift;
    public $keterangan;
    public $jam_mulai;
    public $signature;
    public $periode;
    public $tanggal;
    public $is_emergency_call;
    public $tanggal_estimasi;
    public $no_mfg;
    public $id_quotation;
    public $id_purchase_order;
    public $service_ke;
    public $id_project_unit;
    public $nama_client;

    public $listIdUser = [];

    public $listCustomer = [];
    public $listProject = [];
    public $listMerk = [];
    public $listUser = [];
    public $listFormMaster = [];
    public $listQuotation = [];
    public $listPurchaseOrder = [];
    public $listUnit = [];

    public function render()
    {
        if ($this->id_project) {
            $project = ProjectV2::find($this->id_project);
            $this->no_mfg = $project->no_mfg;
        }
        $this->listProject = ProjectV2::where('id_customer', $this->id_customer)->get();
        $this->listUnit = ProjectUnit::where('id_project', $this->id_project)->get();
        $this->listQuotation = Quotation::where('id_project_unit', $this->id_project_unit)->get();
        $this->dispatchBrowserEvent('contentChange');
        return view('livewire.management-tugas.form');
    }

    public function mount()
    {
        $this->listCustomer = Customer::get();
        $this->listMerk = Merk::get();
        $this->listUser = User::get();
        $this->listFormMaster = FormMaster::get();
        $this->listPurchaseOrder = PreOrder::where('no_ref', '!=', null)
            ->get();
    }

    public function changeQuotation($id_quotation)
    {
        $this->id_quotation = $id_quotation;
    }

    public function simpanManagementTugas()
    {
        $this->validate([
            'id_project_unit' => 'required|numeric',
            'id_merk' => 'required|numeric',
            'id_form_master' => 'required|numeric',
            'nomor_lift' => 'required|string',
            'tanggal' => 'required',
            'tanggal_estimasi' => 'nullable|string',
            'id_quotation' => 'nullable|numeric',
            'keterangan' => 'nullable|string',
            'service_ke' => 'nullable|string',
            'nama_client' => 'nullable|string',
        ], [
            'id_project_unit.required' => 'Project belum dipilih',
            'id_project_unit.numeric' => 'Project tidak valid !',
            'id_merk.required' => 'Merk belum dipilih',
            'id_merk.numeric' => 'Merk tidak valid !',
            'nomor_lift.required' => 'Nomor lift tidak boleh kosong',
            'nomor_lift.string' => 'Nomor Lift tidak valid !',
            'id_form_master.required' => 'Form belum dipilih',
            'tanggal.required' => 'Tanggal Pekerjaan belum dipilih',
            'id_form_master.numeric' => 'Form tidak valid !',
            'tanggal_estimasi.string' => 'Tanggal estimasi tidak valid !',
            'id_quotation.numeric' => 'Quotation tidak valid !',
            'keterangan.string' => 'Keterangan tidak valid !',
            'service_ke.string' => 'Service ke tidak valid !',
            'nama_client.string' => 'Nama client tidak valid !'
        ]);

        if ($this->is_emergency_call == 1) {
            $this->periode = 0;
        }

        $unit = ProjectUnit::find($this->id_project_unit);
        if (!$unit) {
            $message = 'Data unit tidak ditemukan !';

            return session()->flash('fail', $message);
        }

        $merk = Merk::find($this->id_merk);
        if (!$merk) {
            $message = 'Data merk tidak ditemukan !';

            return session()->flash('fail', $message);
        }
        $formMaster = FormMaster::find($this->id_form_master);
        if (!$formMaster) {
            $message = 'Data form tidak ditemukan !';

            return session()->flash('fail', $message);
        }
        if ($this->id_laporan_pekerjaan == null) {
            $helper = new HelperController;
            $number = LaporanPekerjaan::whereYear('created_at', date('Y'))
                ->count();
            $number = $helper->format_num($number + 1, 4, null);
            if ($this->is_emergency_call == 1) {
                $jenis = 'LP';
            } else {
                $jenis = 'SVC';
            }
            $data['no_ref'] = date('Y') . '/' . $jenis . '/' . $number;
        }
        $quotation = Quotation::find($this->id_quotation);
        $data['id_project_unit'] = $this->id_project_unit;
        $data['id_merk'] = $this->id_merk;
        $data['nomor_lift'] = $this->nomor_lift;
        $data['periode'] = $this->periode;
        $data['tanggal_pekerjaan'] = $this->tanggal;
        $data['id_form_master'] = $this->id_form_master;
        $data['is_emergency_call'] = $this->is_emergency_call ?? 0;
        $data['tangal_estimasi'] = $this->tanggal_estimasi ? date('Y-m-d H:i:s', strtotime($this->tanggal_estimasi)) : null;
        $data['keterangan'] = $this->keterangan;
        $data['service_ke'] = $this->service_ke;
        $data['nama_client'] = $this->nama_client;
        $laporanPekerjaan = LaporanPekerjaan::updateOrCreate([
            'id' => $this->id_laporan_pekerjaan,
        ], $data);

        LaporanPekerjaanUser::where('id_laporan_pekerjaan', $laporanPekerjaan->id)
            ->delete();
        foreach ($this->listIdUser as $item) {
            LaporanPekerjaanUser::create([
                'id_user' => $item,
                'id_laporan_pekerjaan' => $laporanPekerjaan->id,
            ]);
        }

        if ($quotation) {
            $quotation->update([
                'id_laporan_pekerjaan' => $laporanPekerjaan->id
            ]);
            if ($this->id_quotation != null && $laporanPekerjaan->quotation != null && $this->id_laporan_pekerjaan == null) {
                foreach ($quotation->quotationDetail as $item) {
                    LaporanPekerjaanBarang::updateOrCreate([
                        'id_laporan_pekerjaan' => $laporanPekerjaan->id,
                        'id_barang' => $item->id_barang,
                        'qty' => $item->qty,
                        'status' => 0
                    ], [
                        'id_laporan_pekerjaan' => $laporanPekerjaan->id,
                        'id_barang' => $item->id_barang,
                        'qty' => $item->qty,
                        'status' => 1,
                        'konfirmasi' => 0,
                        'peminjam' => session()->get('id_user')
                    ]);
                }
            }
        } elseif (isset($unit->purchaseOrder) && $this->id_laporan_pekerjaan == null) {
            $purchaseOrder = $unit->purchaseOrder;
            foreach ($purchaseOrder->preOrderDetail as $item) {
                LaporanPekerjaanBarang::updateOrCreate([
                    'id_laporan_pekerjaan' => $laporanPekerjaan->id,
                    'id_barang' => $item->id_barang,
                    'qty' => $item->qty,
                    'status' => 0
                ], [
                    'id_laporan_pekerjaan' => $laporanPekerjaan->id,
                    'id_barang' => $item->id_barang,
                    'qty' => $item->qty,
                    'status' => 1,
                    'konfirmasi' => 0,
                    'peminjam' => session()->get('id_user')
                ]);
            }
        }

        $message = 'Data berhasil disimpan';
        activity()->causedBy(HelperController::user())->log("Menyimpan data management tugas");
        $this->resetInputFields();
        $this->emit('refreshManagementTugas');
        $this->emit('finishSimpanData', 1, $message);

        return session()->flash('success', $message);
    }

    public function resetInputFields()
    {
        $this->id_laporan_pekerjaan = null;
        $this->id_project_unit = null;
        $this->id_merk = null;
        $this->nomor_lift = null;
        $this->tanggal = null;
        $this->id_form_master = null;
        $this->listIdUser = [];
        $this->is_emergency_call = null;
        $this->tanggal_estimasi = null;
        $this->keterangan = null;
        $this->service_ke = null;
        $this->id_quotation = null;
        $this->nama_client = null;
    }

    public function setDataManagementTugas($id)
    {
        $laporanPekerjaan = LaporanPekerjaan::find($id);
        if (!$laporanPekerjaan) {
            $message = 'Data tidak ditemukan !';

            return session()->flash('fail', $message);
        }

        $this->id_laporan_pekerjaan = $laporanPekerjaan->id;
        $this->id_project_unit = $laporanPekerjaan->id_project_unit;
        $this->id_merk = $laporanPekerjaan->id_merk;
        $this->nomor_lift = $laporanPekerjaan->nomor_lift;
        $this->id_form_master = $laporanPekerjaan->id_form_master;
        $this->periode = $laporanPekerjaan->periode;
        $this->tanggal = $laporanPekerjaan->tanggal_pekerjaan;
        $this->is_emergency_call = $laporanPekerjaan->is_emergency_call;
        $this->id_quotation = $laporanPekerjaan->quotation ? $laporanPekerjaan->quotation->id : null;
        $this->keterangan = $laporanPekerjaan->keterangan;
        $this->service_ke = $laporanPekerjaan->service_ke;
        $this->nama_client = $laporanPekerjaan->nama_client;
        if ($laporanPekerjaan->tanggal_estimasi) {
            $this->tanggal_estimasi = date('d-m-Y H:i', strtotime($laporanPekerjaan->tanggal_estimasi));
        }

        foreach ($laporanPekerjaan->teknisi as $item) {
            array_push($this->listIdUser, $item->id_user);
        }

        $this->id_project = $laporanPekerjaan->projectUnit->id_project;
        $this->id_customer = $laporanPekerjaan->projectUnit->project->id_customer;

        $projectUnit = ProjectUnit::find($this->id_project_unit);
        if ($projectUnit && $projectUnit->purchaseOrder) {
            $this->id_purchase_order = $projectUnit->purchaseOrder->id;
        }

        if ($this->id_purchase_order) {
            $this->listPurchaseOrder = PreOrder::where('id', $this->id_purchase_order)->where('status', '!=', '3')->get();
        } else {
            $this->listPurchaseOrder = PreOrder::where('no_ref', '!=', null)
                ->where('status', '!=', 3)
                ->get();
        }
    }

    public function changeCustomer($id_customer)
    {
        $this->id_customer = $id_customer;
    }

    public function changePurchaseOrder($id_purchase_order)
    {
        $this->id_purchase_order = $id_purchase_order;
        $purchaseOrder = PreOrder::find($this->id_purchase_order);
        if (!$purchaseOrder) {
            return session()->flash('fail', 'Data PO tidak ditemukan');
        }
        $this->id_quotation = $purchaseOrder->id_quotation;
    }

    public function changeProjectUnit($id_project_unit)
    {
        $this->id_project_unit = $id_project_unit;
        $projectUnit = ProjectUnit::find($this->id_project_unit);
        // if ($projectUnit && $projectUnit->purchaseOrder) {
        //     $this->id_purchase_order = $projectUnit->purchaseOrder->id;
        // }

        if ($this->id_purchase_order) {
            $this->listPurchaseOrder = PreOrder::where('id', $this->id_purchase_order)->where('status', '!=', 3)->get();
        } else {
            $this->listPurchaseOrder = PreOrder::where('no_ref', '!=', null)
                ->where('status', '!=', 3)
                ->get();
        }
    }
}
