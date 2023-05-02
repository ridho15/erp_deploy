<?php

namespace App\Imports;

use App\Models\TemplatePekerjaan;
use App\Models\TemplatePekerjaanDetail;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ImportFormDetail implements ToModel, WithValidation, WithHeadingRow, SkipsEmptyRows
{
    use Importable;

    public $id_form_master;
    /**
    * @param Collection $collection
    */

    public function __construct($id_form_master)
    {
        $this->id_form_master = $id_form_master;
    }
    public function model(array $row)
    {
        if($row['parent'] != null || $row['parent'] != ''){
            $templatePekerjaan = TemplatePekerjaan::where('nama_pekerjaan', 'LIKE', '%' . $row['parent'] . '%')
            ->first();
            if($templatePekerjaan){
                $id_template_pekerjaan = $templatePekerjaan->id;
            }else{
                $id_template_pekerjaan = 0;
            }
            $listPeriode = explode(",",$row['periode']);
            $templatePekerjaanDetail = TemplatePekerjaanDetail::create([
                'id_template_pekerjaan' => $id_template_pekerjaan,
                'nama_pekerjaan' => $row['nama_pekerjaan'],
                'periode' => json_encode($listPeriode),
            ]);
        }else{
            $listPeriode = explode(",", $row['periode']);
            $templatePekerjaan = TemplatePekerjaan::create([
                'nama_pekerjaan' => $row['nama_pekerjaan'],
                'keterangan' => $row['keterangan'],
                'id_form_master' => $this->id_form_master,
                'periode' => json_encode($listPeriode),
            ]);
        }
    }

    public function rules(): array
    {
        return [
            'nama_pekerjaan' => 'required|string',
            'keterangan' => 'nullable|string',
            'parent' => 'nullable|string',
        ];
    }

    public function customValidationMessages()
    {
        return [
            'nama_pekerjaan.required' => 'Nama pekerjaan tidak boleh kosong',
            'nama_pekerjaan.string' => 'nama pekerjaan tidak valid !',
            'keterangan.string' => 'keterangan tidak valid !',
            'parent.string' => 'Parent tidak valid !'
        ];
    }
}
