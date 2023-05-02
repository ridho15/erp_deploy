<?php

namespace App\Imports;

use App\Models\kategori;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ImportKategori implements ToModel, WithValidation, WithHeadingRow, SkipsEmptyRows
{
    use Importable;
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new kategori([
            'nama_kategori' => $row['nama_kategori']
        ]);
    }

    public function rules(): array
    {
        return [
            'nama_kategori' => 'required|string',
        ];
    }

    public function customValidationMessages()
    {
        return [
            'nama_kategori.required' => 'Nama kategori tidak boleh kosong',
            'nama_kategori.string' => 'Nama kategori tidak valid !',
        ];
    }
}
