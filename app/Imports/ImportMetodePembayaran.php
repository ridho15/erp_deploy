<?php

namespace App\Imports;

use App\Models\MetodePembayaran;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ImportMetodePembayaran implements ToModel, WithValidation, WithHeadingRow, SkipsEmptyRows
{
    use Importable;
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new MetodePembayaran([
            'nama_metode' => $row['nama_metode'],
            'nilai' => $row['nilai']
        ]);
    }

    public function rules(): array
    {
        return [
            'nama_metode' => 'required|string',
            'nilai' => 'required|numeric'
        ];
    }

    public function customValidationMessages()
    {
        return [
            'nama_metode.required' => 'Nama metode tidak boleh kosong',
            'nama_metode.string' => 'Nama metode tidak valid !',
            'nilai.required' => 'Nilai tidak boleh kosong',
            'nilai.numeric' => 'Nilai tidak valid !',
        ];
    }
}
