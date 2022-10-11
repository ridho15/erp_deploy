<?php

namespace App\Http\Livewire\ManagementTugas;

use Livewire\Component;
use Livewire\WithPagination;

class Data extends Component
{
    use WithPagination;
    public $paginationTheme = 'bootstrap';
    public $total_show = 10;
    public $cari;
    protected $listLaporanPekerjaan;
    public function render()
    {
        return view('livewire.management-tugas.data');
    }

    public function mount(){

    }
}
