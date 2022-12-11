<?php

namespace App\Http\Livewire;

use App\Models\Notifikasi as ModelsNotifikasi;
use Livewire\Component;

class Notifikasi extends Component
{
    public $listeners = [
        'directNotifikasi'
    ];
    public $listNotifikasi;
    public $totalNotifikasi;
    public function render()
    {
        $this->listNotifikasi = ModelsNotifikasi::where('id_user', session()->get('id_user'))
        ->whereDate('tanggal', now())
        ->get();

        $this->totalNotifikasi = ModelsNotifikasi::where('id_user', session()->get('id_user'))
        ->whereDate('tanggal', now())
        ->where('status_lihat', 0)
        ->count();
        return view('livewire.notifikasi');
    }

    public function directNotifikasi($id){
        $notifikasi = ModelsNotifikasi::find($id);
        if($notifikasi){
            $notifikasi->update([
                'status_lihat' => 1
            ]);

            return redirect()->route($notifikasi->route);
        }
    }
}
