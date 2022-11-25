<?php

namespace App\Http\Livewire\ManagementTugas;

use App\Models\Customer;
use App\Models\FormMaster;
use App\Models\LaporanPekerjaan;
use App\Models\LaporanPekerjaanUser;
use App\Models\Merk;
use App\Models\ProjectV2;
use App\Models\User;
use Livewire\Component;

class Form extends Component
{
    public $listeners = [
        'simpanManagementTugas',
        'setDataManagementTugas',
        'changeCustomer',
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

    public $listIdUser = [];

    public $listCustomer = [];
    public $listProject = [];
    public $listMerk = [];
    public $listUser = [];
    public $listFormMaster = [];

    public function render()
    {
        $this->listCustomer = Customer::get();
        $this->listProject = ProjectV2::get();
        $this->listMerk = Merk::get();
        $this->listUser = User::get();
        $this->listFormMaster = FormMaster::get();

        if($this->id_project){
            $project = ProjectV2::find($this->id_project);
            $this->no_mfg = $project->no_mfg;
        }

        $this->dispatchBrowserEvent('contentChange');

        return view('livewire.management-tugas.form');
    }

    public function mount()
    {
    }

    public function simpanManagementTugas()
    {
        $this->validate([
            'id_customer' => 'required|numeric',
            'id_project' => 'required|numeric',
            'id_merk' => 'required|numeric',
            'id_form_master' => 'required|numeric',
            'nomor_lift' => 'required|numeric',
            'tanggal' => 'required',
            'tanggal_estimasi' => 'nullable|string'
        ], [
            'id_customer.required' => 'Customer belum dipilih',
            'id_customer.numeric' => 'Customer tidak valid !',
            'id_project.required' => 'Project belum dipilih',
            'id_project.numeric' => 'Project tidak valid !',
            'id_merk.required' => 'Merk belum dipilih',
            'id_merk.numeric' => 'Merk tidak valid !',
            'nomor_lift.required' => 'Nomor lift tidak boleh kosong',
            'nomor_lift.numeric' => 'Nomor Lift tidak valid !',
            'id_form_master.required' => 'Form belum dipilih',
            'tanggal.required' => 'Tanggal Pekerjaan belum dipilih',
            'id_form_master.numeric' => 'Form tidak valid !',
            'tanggal_estimasi.string' => 'Tanggal estimasi tidak valid !'
        ]);

        if($this->is_emergency_call == 1){
            $this->periode = 0;
        }

        $customer = Customer::find($this->id_customer);
        if (!$customer) {
            $message = 'Data customer tidak ditemukan !';

            return session()->flash('fail', $message);
        }

        $project = ProjectV2::find($this->id_project);
        if (!$project) {
            $message = 'Data project tidak ditemukan !';

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

        $laporanPekerjaan = LaporanPekerjaan::updateOrCreate([
            'id' => $this->id_laporan_pekerjaan,
        ], [
            'id_customer' => $this->id_customer,
            'id_project' => $this->id_project,
            'id_merk' => $this->id_merk,
            'nomor_lift' => $this->nomor_lift,
            'periode' => $this->periode,
            'tanggal_pekerjaan' => $this->tanggal,
            'id_form_master' => $this->id_form_master,
            'is_emergency_call' => $this->is_emergency_call ?? 0,
            'tanggal_estimasi' => date('Y-m-d H:i:s', strtotime($this->tanggal_estimasi))
        ]);

        LaporanPekerjaanUser::where('id_laporan_pekerjaan', $laporanPekerjaan->id)
        ->delete();
        foreach ($this->listIdUser as $item) {
            LaporanPekerjaanUser::create([
                'id_user' => $item,
                'id_laporan_pekerjaan' => $laporanPekerjaan->id,
            ]);
        }

        $message = 'Data berhasil disimpan';
        $this->resetInputFields();
        $this->emit('refreshManagementTugas');
        $this->emit('finishSimpanData', 1, $message);

        return session()->flash('success', $message);
    }

    public function resetInputFields()
    {
        $this->id_laporan_pekerjaan = null;
        $this->id_customer = null;
        $this->id_project = null;
        $this->id_merk = null;
        $this->nomor_lift = null;
        $this->tanggal = null;
        $this->id_form_master = null;
        $this->listIdUser = [];
        $this->is_emergency_call = null;
        $this->tanggal_estimasi = null;
    }

    public function setDataManagementTugas($id)
    {
        $laporanPekerjaan = LaporanPekerjaan::find($id);
        if (!$laporanPekerjaan) {
            $message = 'Data tidak ditemukan !';

            return session()->flash('fail', $message);
        }

        $this->id_laporan_pekerjaan = $laporanPekerjaan->id;
        $this->id_customer = $laporanPekerjaan->id_customer;
        $this->id_project = $laporanPekerjaan->id_project;
        $this->id_merk = $laporanPekerjaan->id_merk;
        $this->nomor_lift = $laporanPekerjaan->nomor_lift;
        $this->id_form_master = $laporanPekerjaan->id_form_master;
        $this->periode = $laporanPekerjaan->periode;
        $this->tanggal = $laporanPekerjaan->tanggal_pekerjaan;
        $this->is_emergency_call = $laporanPekerjaan->is_emergency_call;
        if($laporanPekerjaan->tanggal_estimasi){
            $this->tanggal_estimasi = date('d-m-Y H:i', strtotime($laporanPekerjaan->tanggal_estimasi));
        }

        foreach ($laporanPekerjaan->teknisi as $item) {
            array_push($this->listIdUser, $item->id_user);
        }
    }

    public function changeCustomer($id_customer)
    {
        $this->id_customer = $id_customer;
    }
}
