<?php

namespace App\Imports;

use App\Models\TipePembayaran;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ImportTipePembayaran implements ToModel, WithValidation, WithHeadingRow, SkipsEmptyRows
{
    use Importable;
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new TipePembayaran([
            'nama_tipe' => $row['nama_tipe'],
        ]);
    }

    public function rules(): array
    {
        return [
            'nama_tipe' => 'required|string',
        ];
    }

    public function customValidationMessages()
    {
        return [
            'nama_tipe.required' => 'Nama tipe tidak boleh kosong',
            'nama_tipe.string' => 'Nama tipe tidak valid !',
        ];
    }
}
