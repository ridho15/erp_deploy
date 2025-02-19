<?php

namespace App\Http\Livewire\Quotation;

use App\Http\Controllers\HelperController;
use App\Models\Customer;
use App\Models\Kostumer;
use App\Models\ProjectUnit;
use App\Models\ProjectV2;
use App\Models\Quotation;
use App\Models\QuotationSales;
use App\Models\Sales;
use App\Models\TipePembayaran;
use Livewire\Component;
use Livewire\WithFileUploads;

class Form extends Component
{
    use WithFileUploads;
    protected $helper;
    function __construct()
    {
        $this->helper = new HelperController;
    }
    public $listeners = [
        'simpanDataQuotation',
        'updateDataQuotation',
        'setDataQuotation',
        'onClickHapusFile',
        'changeKeterangan',
        'changeCustomer',
        'changeSales',
        'changeProject',
        'changeProjectUnit',
    ];
    public $id_quotation;
    public $id_project;
    public $status_response;
    public $id_customer;
    public $file;
    public $keterangan;
    public $hal;
    public $quotation;
    public $listCustomer;
    public $id_project_unit;
    public $nomor_quotation;
    public $tanggal;
    public $ppn;
    public $listIdSales = [];
    public $listProject = [];
    public $listProjectUnit = [];

    public $listSales = [];
    public function render()
    {
        $this->listProject = ProjectV2::where('id_customer', $this->id_customer)->get();
        $this->listProjectUnit = ProjectUnit::where('id_project', $this->id_project)->get();
        $this->dispatchBrowserEvent('contentChange');
        return view('livewire.quotation.form');
    }

    public function mount(){
        $this->listCustomer = Customer::get();
        $this->listSales = Sales::get();
    }

    public function simpanQuotation(){
        $this->validate([
            'status_response' => 'required|numeric',
            'id_tipe_pembayaran' => 'required|numeric',
            'id_project_unit' => 'required|numeric',
            'nomor_quotation' => 'nullable|string',
        ], [
            'id_project_unit.required' => 'Unit belum dipilih',
            'id_project_unit.numeric' => 'Unit tidak valid !',
            'status_response.required' => 'Status Response belum dipilih',
            'status_response.numeric' => 'Status Response tidak valid !',
            'id_tipe_pembayaran.required' => 'Tipe pembayaran belum dipilih',
            'id_tipe_pembayaran.numeric' => 'Tipe pembayaran tidak valid !',
            'nomor_quotation.string' => 'Nomor quotation tidak valid !'
        ]);

        // Check Tipe Pembayaran
        if($this->id_tipe_pembayaran){
            $tipePembayaran = TipePembayaran::find($this->id_tipe_pembayaran);
            if(!$tipePembayaran){
                $message = "Tipe pembayaran tidak ditemukan !";
                return session()->flash('fail', $message);
            }
        }

        // Check Quotation
        $quotation = Quotation::find($this->id_quotation);
        if(!$quotation){
            $message = "Data quotation tidak ditemuakn !";
            return session()->flash('fail', $message);
        }

        $quotation->update([
            'status_response' => $this->status_reponse,
            'id_tipe_pembayaran' => $this->id_tipe_pembayaran
        ]);

        $message = "Berhasil menyimpan data quotation";
        $this->emit('refreshQuotation');
        $this->emit('finishSimpanData', 1, $message);
        return session()->flash('success', $message);
    }

    public function updateDataQuotation(){
        $this->validate([
            'id_quotation' => 'required|numeric',
            'keterangan' => 'nullable|string',
            'file' => 'nullable|mimes:pdf,docx,xlsx|max:10240',
            'hal' => 'nullable|string',
            'nomor_quotation' => 'required|string'
        ], [
            'id_quotation.required' => 'Quotation tidak valid !',
            'id_quotation.numeric' => 'Quotation tidak valid !',
            'keterangan.string' => 'Keterangan tidak valid !',
            'file.mimes' => 'File tidak valid !',
            'file.max' => 'Ukuran file terlalu besar, maximal 10Mb',
            'hal.string' => 'Perihal tidak valid !',
            'nomor_quotation.required' => 'Nomor quotation tidak boleh kosong',
            'nomor_quotation.string' => 'Nomor quotation tidak valid !',
        ]);

        $quotation = Quotation::find($this->id_quotation);
        if(!$quotation){
            $message = "Data quotation tidak ditemukan !";
            $this->emit('finishSimpanData', 0, $message);
            return session()->flash('fail', $message);
        }

        $data['keterangan'] = $this->keterangan;
        $data['hal'] = $this->hal;
        $data['ppn'] = $this->ppn;
        $data['nomor_quotation'] = $this->nomor_quotation;
        $data['tanggal'] = $this->tanggal;
        if($this->file){
            $path = $this->file->store('public/quotation_file');
            $path = str_replace('public', '', $path);
            $data['file'] = $path;
        }
        $quotation->update($data);

        QuotationSales::where('id_quotation', $quotation->id)->delete();
        foreach ($this->listIdSales as $item) {
            QuotationSales::create([
                'id_quotation' => $quotation->id,
                'id_sales' => $item
            ]);
        }

        $message = "Berhasil mengupdate data quotation";
        activity()->causedBy(HelperController::user())->log("Mengupdate data quotation");
        $this->resetInputFields();
        $this->emit('finishSimpanData', 1, $message);
        $this->emit('refreshQuotation');
        return session()->flash('success', $message);
    }

    public function setDataQuotation($id){
        $quotation = Quotation::find($id);
        if(!$quotation){
            $message = "Data quotation tidak ditemukan !";
            $this->emit('finishSimpanData', 0, $message);
            return session()->flash('fail', $message);
        }

        $this->id_quotation = $quotation->id;
        $this->id_project = $quotation->id_project;
        $this->keterangan = $quotation->keterangan;
        $this->hal = $quotation->hal;
        $this->nomor_quotation = $quotation->nomor_quotation;
        $this->tanggal = $quotation->tanggal;
        $this->ppn = $quotation->ppn;
        $this->quotation = $quotation;

        $this->listIdSales = [];
        foreach ($quotation->quotationSales as $item) {
            array_push($this->listIdSales, $item->id_sales);
        }
    }

    public function resetInputFields(){
        $this->quotation = null;
        $this->id_quotation = null;
        $this->file = null;
        $this->keterangan = null;
        $this->listIdSales = [];
        $this->nomor_quotation = null;
        $this->ppn = null;
        $this->tanggal = null;
    }

    public function onClickHapusFile(){
        $this->file = null;
    }

    public function changeKeterangan($keterangan){
        $this->keterangan = $keterangan;
    }

    public function changeCustomer($id_customer){
        $this->id_customer = $id_customer;
        $customer = Kostumer::find($this->id_customer);
        $this->ppn = $customer->ppn;
    }

    public function simpanDataQuotation(){
        $this->validate([
            'id_customer' => 'required|numeric',
            'id_project_unit' => 'required|numeric',
            'keterangan' => 'nullable|string',
            'hal' => 'nullable|string',
            'file' => 'nullable|mimes:pdf,docx,xlsx|max:10240',
            'nomor_quotation' => 'nullable|string'
        ], [
            'id_customer.required' => 'Data customer tidak valid !',
            'id_customer.numeric' => 'Data customer tidak valid !',
            'id_project_unit.numeric' => 'Data Project tidak valid !',
            'id_project_unit.numeric' => 'Data Project tidak valid !',
            'keterangan.string' => 'Keterangan tidak valid !',
            'file.mimes' => 'File tidak valid !',
            'file.max' => 'Ukuran file terlalu besar, maximal 10Mb',
            'hal.string' => 'Perihal tidak valid !',
            'nomor_quotation.string' => 'Nomor Quotation tidak valid !'
        ]);

        // Check data customer
        $customer = Customer::find($this->id_customer);
        if(!$customer){
            $message = "Data customer tidak ditemukan !";
            $this->emit('finishSimpanData', 0, $message);
            return session()->flash('fail', $message);
        }

        $data['id_customer'] = $this->id_customer;
        $data['id_project_unit'] = $this->id_project_unit;
        $data['keterangan'] = $this->keterangan;
        $data['hal'] = $this->hal;
        $data['ppn'] = $this->ppn;
        $data['nomor_quotation'] = $this->nomor_quotation;
        $data['tanggal'] = $this->tanggal;
        if($this->file){
            $path = $this->file->store('public/quotation_file');
            $path = str_replace('public', '', $path);
            $data['file'] = $path;
        }

        $quotation = Quotation::updateOrCreate([
            'id' => $this->id_quotation
        ],$data);

        QuotationSales::where('id_quotation', $quotation->id)->delete();
        foreach ($this->listIdSales as $item) {
            QuotationSales::create([
                'id_quotation' => $quotation->id,
                'id_sales' => $item
            ]);
        }

        $message = "Berhasil menyimpan data quotation";
        activity()->causedBy(HelperController::user())->log($message);
        $this->resetInputFields();
        $this->emit('finishSimpanData', 1, $message);
        $this->emit('refreshQuotation');
        return session()->flash('success', $message);
    }

    public function changeSales($listIdSales){
        $this->listIdSales = $listIdSales;
    }

    public function changeProject($id_project){
        $this->id_project = $id_project;
    }

    public function changeProjectUnit($id_project_unit){
        $this->id_project_unit = $id_project_unit;
    }
}
