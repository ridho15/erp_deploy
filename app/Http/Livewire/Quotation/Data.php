<?php

namespace App\Http\Livewire\Quotation;

use App\Mail\SendQuotationMail;
use App\Models\ProjectV2;
use App\Models\Quotation;
use App\Models\QuotationSendLog;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Livewire\WithPagination;

class Data extends Component
{
    use WithPagination;
    public $listeners = [
        'refreshQuotation' => '$refresh',
        'hapusQuotation',
        'sendQuotationToCustomer',
        'clearFilter',
        'quotationGagal',
        'quotationBerhasil'
    ];
    public $paginationTheme = 'bootstrap';
    public $total_show = 10;
    public $cari;
    protected $listQuotation = [];
    public $listProject = [];

    public $tanggal_dibuat;
    public $id_project;
    public $status_kirim;
    public $status_konfirmasi;
    public function render()
    {
        $this->listProject = ProjectV2::get();
        if($this->cari != null || $this->tanggal_dibuat != null || $this->id_project != null || $this->status_kirim != null || $this->status_konfirmasi != null){
            $this->listQuotation = Quotation::where(function($query){
                $query->where('keterangan', 'LIKE', '%' . $this->cari . '%')
                ->orWhere('hal' ,'LIKE', '%' . $this->cari . '%')
                ->orWhereHas('laporanPekerjaan', function($query){
                    $query->whereHas('project', function($query){
                        $query->where('nama', 'LIKE', '%' . $this->cari . '%')
                        ->orWhere('kode', 'LIKE', '%' . $this->cari . '$');
                    });
                });
            })
            ->where(function($query){
                $query->whereDate('created_at', $this->tanggal_dibuat)
                ->orWhereHas('laporanPekerjaan', function($query){
                    $query->where('id_project', $this->id_project);
                })->orWhere('status', $this->status_kirim)
                ->orWhere('konfirmasi', $this->status_konfirmasi);
            })
            ->orderBy('created_at', 'DESC')
            ->paginate($this->total_show);
        }else{
            $this->listQuotation = Quotation::orderBy('created_at', 'DESC')
            ->paginate($this->total_show);
        }
        $data['listQuotation'] = $this->listQuotation;

        $this->dispatchBrowserEvent('contentChange');
        return view('livewire.quotation.data', $data);
    }

    public function mount(){
    }

    public function hapusQuotation($id){
        $quotation = Quotation::find($id);
        if(!$quotation){
            $mesasge = "Data quotaion tidak ditemukan !";

            return session()->flash('fail', $mesasge);
        }

        $quotation->delete();
        $mesasge = "Berhasil menghapus quotation";
        $this->emit('finishRefreshQuotation', 1, $mesasge);
        return session()->flash('success', $mesasge);
    }

    public function sendQuotationToCustomer($id){
        // Check Quotation
        $quotation = Quotation::find($id);
        if(!$quotation){
            $mesasge = "Data Quotation tidak ditemukan !";
            $this->emit('finishRefreshData',0, $mesasge);
            return session()->flash('fail', $mesasge);
        }
        $email = null;
        if($quotation->laporanPekerjaan){
            $email = $quotation->laporanPekerjaan->customer->email;
        }elseif($quotation->customer){
            $email = $quotation->customer->email;
        }
        if ($email) {
            Mail::to($email)->send(new SendQuotationMail($id));
            $quotation->update([
                'status' => 1,
            ]);
        }
        QuotationSendLog::create([
            'id_quotation' => $quotation->id,
            'id_user' => session()->get('id_user'),
            'tanggal' => now()
        ]);
        $message= "Quotation Berhasil dikirim";
        $this->emit('finishRefreshData', 1, $message);
        return session()->flash('success', $message);
    }

    public function clearFilter(){
        $this->tanggal_dibuat = null;
        $this->id_project = null;
        $this->status_kirim = null;
        $this->status_konfirmasi = null;
    }

    public function quotationGagal($id){
        $quotation = Quotation::find($id);
        if(!$quotation){
            $message = "Data quotation tidak ditemukan";
            return session()->flash('fail', $message);
        }

        $quotation->update([
            'status_like' => 0
        ]);

        $message = "Quotation Gagal";
        return session()->flash('fail', $message);
    }

    public function quotationBerhasil($id){
        $quotation = Quotation::find($id);
        if(!$quotation){
            $message = "Data quotation tidak ditemukan";
            return session()->flash('fail', $message);
        }

        $quotation->update([
            'status_like' => 1
        ]);

        $message = "Quotation Berhasil";

        return redirect()->route('pre-order')->with('success', $message);
        // return session()->flash('success', $mesasge);
    }
}
