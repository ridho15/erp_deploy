<?php

namespace App\Imports;

use App\Models\satuan;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ImportSatuan implements ToModel, WithValidation, WithHeadingRow, SkipsEmptyRows
{
    use Importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new satuan([
            'nama_satuan' => $row['nama_satuan'],
            'nilai' => $row['nilai']
        ]);
    }

    public function rules(): array
    {
        return [
            'nama_satuan' => 'required|string',
            'nilai' => 'required|numeric',
        ];
    }

    public function customValidationMessages()
    {
        return [
            'nama_satuan.required' => 'Nama satuan tidak boleh kosong',
            'nama_satuan.string' => 'Nama satuan tidak valid !',
            'nilai.required' => 'Nilai tidak boleh kosong !',
            'nilai.numeric' => 'Nilai tidak valid !',
        ];
    }
}
