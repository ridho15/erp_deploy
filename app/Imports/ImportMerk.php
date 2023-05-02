<?php

namespace App\Imports;

use App\Models\merk;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ImportMerk implements ToModel, WithValidation, WithHeadingRow, SkipsEmptyRows
{
    use Importable;
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new merk([
            'nama_merk' => $row['nama_merk']
        ]);
    }

    public function rules(): array
    {
        return [
            'nama_merk' => 'required|string',
        ];
    }

    public function customValidationMessages()
    {
        return [
            'nama_merk.required' => 'Nama merk boleh kosong',
            'nama_merk.string' => 'Nama merk tidak valid !',
        ];
    }
}
