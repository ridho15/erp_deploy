<?php

namespace App\Http\Livewire\Laporan;

use App\Models\ActivityLog;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class LogActivity extends Component
{
    use WithPagination;
    public $paginationTheme = 'bootstrap';
    public $cari;
    public $total_show = 10;

    protected $listLogActivity;
    public $tanggal;
    public $causer_id;
    public $listUser = [];
    public function render()
    {
        $this->listUser = User::get();
        $this->listLogActivity = ActivityLog::where(function($query){
            $query->where('description', 'LIKE', '%' . $this->cari . '%')
            ->orWhereHas('user', function($query){
                $query->where('name', 'LIKE', '%' . $this->cari . '%');
            });
        })->where(function($query){
            if($this->causer_id){
                $query->where('causer_id', $this->causer_id);
            }
        })
        ->whereDate('updated_at', $this->tanggal)->orderBy('updated_at', 'DESC')->paginate($this->total_show);
        $data['listLogActivity'] = $this->listLogActivity;
        $this->dispatchBrowserEvent('contentChange');
        return view('livewire.laporan.log-activity', $data);
    }

    public function mount(){
        $this->tanggal = date('Y-m-d');
    }
}
