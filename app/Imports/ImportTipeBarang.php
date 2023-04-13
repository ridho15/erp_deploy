<?php

namespace App\Imports;

use App\Models\TipeBarang;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ImportTipeBarang implements ToModel, WithValidation, WithHeadingRow
{
    use Importable;
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new TipeBarang([
            'tipe_barang' => $row['tipe_barang']
        ]);
    }

    public function rules(): array
    {
        return [
            'tipe_barang' => 'required|string',
        ];
    }

    public function customValidationMessages()
    {
        return [
            'tipe_barang.required' => 'Tipe barang tidak boleh kosong',
            'tipe_barang.string' => 'Tipe barang tidak valid !',
        ];
    }
}
