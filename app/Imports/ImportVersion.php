<?php

namespace App\Imports;

use App\Models\Version;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ImportVersion implements ToModel, WithValidation, WithHeadingRow, SkipsEmptyRows
{
    use Importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Version([
            'version' => $row['version']
        ]);
    }

    public function rules(): array
    {
        return [
            'version' => 'required|string',
        ];
    }

    public function customValidationMessages()
    {
        return [
            'version.required' => 'Version tidak boleh kosong',
            'version.string' => 'version tidak valid !',
        ];
    }
}
