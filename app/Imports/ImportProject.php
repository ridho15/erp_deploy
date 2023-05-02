<?php

namespace App\Imports;

use App\Models\Customer;
use App\Models\Project;
use App\Models\ProjectV2;
use App\Models\Sales;
use App\Models\SalesProject;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class ImportProject implements ToModel, WithValidation, WithHeadingRow
{
    use Importable;
    /**
     * @param Collection $collection
     */
    public function model(array $row)
    {
        $tanggal = Date::excelToDateTimeObject($row['tanggal']);
        $customer = Customer::where('nama', 'LIKE', '%' . $row['customer'] . '%')
            ->first();

        if ($customer) {
            $id_customer = $customer->id;
        } else {
            $id_customer = 0;
        }
        $project = ProjectV2::updateOrCreate([
            'kode' => $row['kode']
        ],[
            'kode' => $row['kode'],
            'nama' => $row['nama'],
            'penanggung_jawab' => $row['penanggung_jawab'],
            'no_mfg' => $row['no_mfg'],
            'alamat' => $row['alamat'],
            'id_customer' => $id_customer,
            'no_hp' => str_replace('-', '', $row['no_hp']),
            'email' => $row['email'],
            'catatan' => $row['catatan'],
            'tanggal' => $tanggal,
            'map' => $row['map'],
            'total_pekerjaan' => $row['total_pekerjaan'],
        ]);

        $listNama = explode(",", $row['pic']);
        foreach ($listNama as $nama) {
            $sales = Sales::where('nama', 'LIKE', '%' . $nama . '%')
                ->first();
            if ($sales) {
                SalesProject::create([
                    'id_project' => $project->id,
                    'id_sales' => $sales->id
                ]);
            }
        }
        return $project;
    }

    public function rules(): array
    {
        return [
            'kode' => 'required|string',
            'nama' => 'required|string',
            'alamat' => 'string|string|max:255',
            'customer' => 'required|string',
            'catatan' => 'nullable|string',
            // 'tanggal' => 'nullable|date_format:d/m/Y',
            'map' => 'nullable|string',
            'total_pekerjaan' => 'nullable|numeric',
            'email' => 'nullable|string|email',
            'no_hp' => 'nullable|string',
            'penanggung_jawab' => 'nullable|string'
        ];
    }

    public function customValidationMessages()
    {
        return [
            'kode.required' => 'Kode tidak boleh kosong',
            'kode.string' => 'Kode tidak valid !',
            'nama.required' => 'Nama tidak boleh kosong',
            'nama.string' => 'Nama tidak valid !',
            'alamat.required' => 'Alamat tidak boleh kosong',
            'alamat.string' => 'Alamat tidak valid !',
            'customer.required' => 'Customer tidak boleh kosong',
            'customer.string' => 'Customer tidak valid !',
            'map.string' => 'Map tidak valid !',
            'total_pekerjaan.numeric' => 'Total pekerjaan tidak valid. Total pekerjaan harus angka !',
            'email.string' => 'email tidak valid !',
        ];
    }
}
