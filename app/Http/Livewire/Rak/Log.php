<?php

namespace App\Http\Livewire\Rak;

use App\Models\RakLog;
use Livewire\Component;
use Livewire\WithPagination;

class Log extends Component
{
    use WithPagination;
    public $paginationTheme = 'bootstrap';
    public $cari;
    public $total_show = 10;
    public $id_rak;
    protected $listRakLog;
    public function render()
    {
        $this->listRakLog = RakLog::where('id_rak', $this->id_rak)
        ->whereHas('barang')
        ->orderBy('updated_at', "DESC")
        ->paginate($this->total_show);

        $data['listRakLog'] = $this->listRakLog;
        return view('livewire.rak.log', $data);
    }

    public function mount($id_rak){
        $this->id_rak = $id_rak;
    }
}
