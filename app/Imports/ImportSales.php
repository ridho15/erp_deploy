<?php

namespace App\Imports;

use App\Models\sales;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ImportSales implements ToModel, WithValidation, WithHeadingRow
{
    use Importable;
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new sales([
            'nama' => $row['nama'],
            'no_hp' => $row['no_hp'],
            'alamat' => $row['alamat'],
            'nama_perusahaan' => $row['nama_perusahaan'],
        ]);
    }

    public function rules(): array
    {
        return [
            'nama' => 'required|string',
            'no_hp' => 'required|string',
            'alamat' => 'nullable|string',
            'nama_perusahaan' => 'nullable|string'
        ];
    }

    public function customValidationMessages(){
        return [
            'nama.required' => 'Nama tidak boleh kosong',
            'nama.string' => 'Nama tidak valid !',
            'no_hp.required' => 'Nomor Hp tidak boleh kosong !',
            'no_hp.string' => 'Nomor Hp tidak valid !',
            'alamat.string' => 'Alamat tidak valid !',
            'nama_perusahaan' => 'Nama perusahaan tidak valid !'
        ];
    }
}
