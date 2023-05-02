<?php

namespace App\Imports;

use App\Models\FormMaster;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ImportForm implements ToModel, WithValidation, WithHeadingRow, SkipsEmptyRows
{
    use Importable;
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $listPeriode = explode(",", $row['periode']);
        return new FormMaster([
            'kode' => $row['kode'],
            'nama' => $row['nama'],
            'keterangan' => $row['keterangan'],
            'periode' => json_encode($listPeriode)
        ]);
    }

    public function rules(): array
    {
        return [
            'kode' => 'required|string',
            'nama' => 'required|string',
            'keterangan' => 'nullable|string',
            'periode' => 'nullable|string'
        ];
    }

    public function customValidationMessages()
    {
        return [
            'kode.required' => 'Kode tidak boleh kosong',
            'kode.string' => 'Kode tidak valid !',
            'nama.required' => 'Nama tidak boleh kosong',
            'nama.string' => 'Nama tidak valid !',
            'keterangan.string' => 'Keterangan tidak vallid !',
            'periode.string' => 'Periode tidak valid !'
        ];
    }
}
