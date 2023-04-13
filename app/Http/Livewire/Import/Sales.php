<?php

namespace App\Http\Livewire\Import;

use App\Http\Controllers\HelperController;
use App\Imports\ImportSales;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Excel as ExcelSecond;
use Maatwebsite\Excel\Validators\ValidationException;
use Throwable;

class Sales extends Component
{
    use WithFileUploads;
    public $listeners = [
        'simpanData',
        'clearFile'
    ];
    public $file;
    public function render()
    {
        return view('livewire.import.sales');
    }

    public function mount()
    {
    }

    public function simpanData()
    {
        $this->validate([
            'file' => 'required|mimes:doc,csv,xlsx,xls,docx,ppt,odt,ods,odp|max:5000',
        ], [
            'file.required' => 'File untuk di masukkan belum dipiilh',
            'file.mimes' => 'File tidak valid !',
            'file.max' => 'Ukuran file terlalu besar, maximal 5000 Kb'
        ]);
        try {
            activity()->causedBy(HelperController::user())->log("Melakukan import data sales");
            // (new ImportSales)->import($this->file, 'local', ExcelSecond::XLSX);
            $import = new ImportSales;
            $import->import($this->file);
            $message = "Berhasil melakukan import data sales";
            $this->file = null;
            $this->emit('refreshSales');
            return session()->flash('success', $message);
        } catch (ValidationException $e) {
            $failures = $e->failures();

            $message = '';
            foreach ($failures as $failure) {
                $message = $message . $failure->attribute() . ' - ' . $failure->errors()[0] . ", ";
            }

            return session()->flash('fail', $message);
        } catch (Throwable $e) {
            return session()->flash('fail', $e->getMessage());
        }
    }

    public function clearFile()
    {
        $this->file = null;
    }
}
