<?php

namespace App\Http\Livewire\Quotation;

use App\Http\Controllers\HelperController;
use App\Models\Customer;
use App\Models\Quotation;
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
        'changeCustomer'
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
    public function render()
    {
        $this->listCustomer = Customer::get();
        $this->dispatchBrowserEvent('contentChange');
        return view('livewire.quotation.form');
    }

    public function mount(){

    }

    public function simpanQuotation(){
        $this->validate([
            'status_response' => 'required|numeric',
            'id_tipe_pembayaran' => 'required|numeric',
        ], [
            'status_response.required' => 'Status Response belum dipilih',
            'status_response.numeric' => 'Status Response tidak valid !',
            'id_tipe_pembayaran.required' => 'Tipe pembayaran belum dipilih',
            'id_tipe_pembayaran.numeric' => 'Tipe pembayaran tidak valid !'
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
        ], [
            'id_quotation.required' => 'Quotation tidak valid !',
            'id_quotation.numeric' => 'Quotation tidak valid !',
            'keterangan.string' => 'Keterangan tidak valid !',
            'file.mimes' => 'File tidak valid !',
            'file.max' => 'Ukuran file terlalu besar, maximal 10Mb',
            'hal.string' => 'Perihal tidak valid !'
        ]);

        $quotation = Quotation::find($this->id_quotation);
        if(!$quotation){
            $message = "Data quotation tidak ditemukan !";
            $this->emit('finishSimpanData', 0, $message);
            return session()->flash('fail', $message);
        }

        $data['keterangan'] = $this->keterangan;
        $data['hal'] = $this->hal;
        if($this->file){
            $path = $this->file->store('public/quotation_file');
            $path = str_replace('public', '', $path);
            $data['file'] = $path;
        }
        $quotation->update($data);

        $message = "Berhasil mengupdate data quotation";
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
        $this->status_reponse = $quotation->status_response;
        $this->id_tipe_pembayaran = $quotation->id_tipe_pembayaran;
        $this->quotation = $quotation;
        $this->keterangan = $quotation->keterangan;
    }

    public function resetInputFields(){
        $this->quotation = null;
        $this->id_quotation = null;
        $this->file = null;
        $this->keterangan = null;
    }

    public function onClickHapusFile(){
        $this->file = null;
    }

    public function changeKeterangan($keterangan){
        $this->keterangan = $keterangan;
    }

    public function changeCustomer($id_customer){
        $this->id_customer = $id_customer;
    }

    public function simpanDataQuotation(){
        $this->validate([
            'id_customer' => 'required|numeric',
            'keterangan' => 'nullable|string',
            'hal' => 'nullable|string',
            'file' => 'nullable|mimes:pdf,docx,xlsx|max:10240',
        ], [
            'id_customer.required' => 'Data customer tidak valid !',
            'id_customer.numeric' => 'Data customer tidak valid !',
            'keterangan.string' => 'Keterangan tidak valid !',
            'file.mimes' => 'File tidak valid !',
            'file.max' => 'Ukuran file terlalu besar, maximal 10Mb',
            'hal.string' => 'Perihal tidak valid !'
        ]);

        // Check data customer
        $customer = Customer::find($this->id_customer);
        if(!$customer){
            $message = "Data customer tidak ditemukan !";
            $this->emit('finishSimpanData', 0, $message);
            return session()->flash('fail', $message);
        }

        $data['id_customer'] = $this->id_customer;
        $data['keterangan'] = $this->keterangan;
        $data['hal'] = $this->hal;
        if($this->file){
            $path = $this->file->store('public/quotation_file');
            $path = str_replace('public', '', $path);
            $data['file'] = $path;
        }

        Quotation::updateOrCreate([
            'id' => $this->id_quotation
        ],$data);

        $message = "Berhasil menyimpan data quotation";
        $this->resetInputFields();
        $this->emit('finishSimpanData', 1, $message);
        return session()->flash('success', $message);
    }
}
