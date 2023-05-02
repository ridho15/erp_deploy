<?php

namespace App\Http\Livewire\Import;

use App\Http\Controllers\HelperController;
use App\Imports\ImportBarang;
use App\Imports\ImportKategori;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Validators\ValidationException;
use Throwable;

class Barang extends Component
{
    use WithFileUploads;
    public $listeners = [
        'clearFile',
        'simpanData'
    ];

    public $file;
    public function render()
    {
        return view('livewire.import.barang');
    }

    public function clearFile()
    {
        $this->file = null;
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
            activity()->causedBy(HelperController::user())->log("Melakukan import data barang");
            // (new ImportSales)->import($this->file, 'local', ExcelSecond::XLSX);
            $import = new ImportBarang;
            $import->import($this->file);
            $message = "Berhasil melakukan import data barang";
            $this->file = null;
            $this->emit('refreshDataBarang');
            return session()->flash('success', $message);
        } catch (ValidationException $e) {
            $failures = $e->failures();

            $message = '';
            foreach ($failures as $failure) {
                $message = $message . $failure->attribute() . ' - ' . $failure->errors()[0] . ", ";
            }
            $this->emit('refreshDataBarang');
            return session()->flash('fail', $message);
        } catch (Throwable $e) {
            $this->emit('refreshDataBarang');
            return session()->flash('fail', $e->getMessage());
        }
        $this->emit('refreshDataBarang');
    }
}
