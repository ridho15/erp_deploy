<?php

namespace App\Imports;

use App\Models\Supplier;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ImportSupplier implements ToModel, WithValidation, WithHeadingRow
{
    use Importable;
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        if ($row['status'] == 'Aktif') {
            $status = 1;
        } else {
            $status = 0;
        }
        return new Supplier([
            'name' => $row['name'],
            'alamat' => $row['alamat'],
            'email' => $row['email'],
            'status' => $status,
            'no_hp_1' => $row['no_hp_1'],
            'no_hp_2' => $row['no_hp_2'],
            'telp_1' => $row['telp_1'],
            'telp_2' => $row['telp_2'],
            'pic' => $row['pic'],
            'produk' => $row['produk']
        ]);
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'alamat' => 'nullable|string',
            'email' => 'nullable|string|email',
            'status' => 'nullable|string',
            'no_hp_1' => 'nullable|string',
            'no_hp_2' => 'nullable|string',
            'telp_1' => 'nullable|string',
            'telp_2' => 'nullable|string',
        ];
    }

    public function customValidationMessages()
    {
        return [
            'name.required' => 'Nama tidak boleh kosong',
            'name.string' => 'Nama tidak valid !',
            'alamat.string' => 'Alamat tidak valid !',
            'email.string' => 'Email tidak valid !',
            'email.email' => 'Email tidak valid !',
            'no_hp_1.string' => 'Nomor Hp 1 tidak valid !',
            'no_hp_2.string' => 'Nomor Hp 2tidak valid !',
            'telp_1.string' => 'Telp 1 tidak valid !',
            'telp_2.string' => 'Telp 2 tidak valid !',
        ];
    }
}
