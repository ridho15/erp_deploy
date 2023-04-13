<?php

namespace App\Imports;

use App\Models\kondisi;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ImportKondisi implements ToModel, WithValidation, WithHeadingRow
{
    use Importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new kondisi([
            'kode' => $row['kode'],
            'keterangan' => $row['keterangan']
        ]);
    }

    public function rules(): array
    {
        return [
            'kode' => 'required|string',
            'keterangan' => 'required|string'
        ];
    }

    public function customValidationMessages(){
        return [
            'kode.required' => 'Kode tidak boleh kosong',
            'kode.string' => 'Kode tidak valid !',
            'keterangan.required' => 'Keterangan tidak boleh kosong',
            'keterangan.string' => 'Keterangan tidak valid !',
        ];
    }
}
