<?php

namespace App\Http\Livewire\Form;

use App\Models\FormMaster;
use Livewire\Component;

class Detail extends Component
{
    public $listeners = ['refreshForm' => '$refreshForm'];
    public $id_form_master;
    public $formMaster;
    public function render()
    {
        $this->formMaster = FormMaster::find($this->id_form_master);
        return view('livewire.form.detail');
    }

    public function mount($id_form_master){
        $this->id_form_master = $id_form_master;
    }
}
