<?php

namespace App\Http\Livewire\Reschedule;

use App\Models\LaporanPekerjaan;
use Livewire\Component;
use Livewire\WithPagination;

class Data extends Component
{
    use WithPagination;
    public $paginationTheme = 'bootstrap';
    public $total_show = 10;
    public $cari;
    protected $listPekerjaan;
    public function render()
    {
        return view('livewire.reschedule.data');
    }
}
