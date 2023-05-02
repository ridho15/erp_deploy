<?php

namespace App\Imports;

use App\Models\Kostumer;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ImportCustomer implements ToModel, WithValidation, WithHeadingRow, SkipsEmptyRows
{
    use Importable;
    /**
     * @param Collection $collection
     */
    public function model(array $row)
    {
        if ($row['status'] == 'Aktif') {
            $status = 1;
        } else {
            $status = 0;
        }
        return new Kostumer([
            'nama' => $row['nama'],
            'no_hp_1' => $row['no_hp_1'],
            'no_hp_2' => $row['no_hp_2'],
            'telp_1' => $row['telp_1'],
            'telp_2' => $row['telp_2'],
            'email' => $row['email'],
            'alamat' => $row['alamat'],
            'status' => $status,
            'barang_customer' => $row['barang_customer'],
            'ppn' => $row['ppn'],
            'pic' => $row['pic'],
        ]);
    }

    public function rules(): array
    {
        return [
            'nama' => 'required|string',
            'no_hp_1' => 'nullable|string',
            'no_hp_2' => 'nullable|string',
            'telp_1' => 'nullable|string',
            'telp_2' => 'nullable|string',
            'email' => 'required|string|email',
            'alamat' => 'nullable|string',
            'barang_customer' => 'nullable|string',
            'ppn' => 'required|numeric',
            'pic' => 'nullable|string'
        ];
    }

    public function customValidationMessages()
    {
        return [
            'email.email' => 'Email tidak valid !',
        ];
    }
}
