<?php

namespace App\Http\Livewire\Laporan;

use Livewire\Component;
use Livewire\WithPagination;

class AccountReceivable extends Component
{
    use WithPagination;
    public $paginationTheme = 'bootstrap';
    public $total_show = 10;
    public $cari;

    public function render()
    {
        return view('livewire.laporan.account-receivable');
    }
}
