<?php

namespace App\Imports;

use App\Models\Barang;
use App\Models\Merk;
use App\Models\Satuan;
use App\Models\TipeBarang;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ImportBarang implements ToModel, WithValidation, WithHeadingRow
{
    use Importable;
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $merk = Merk::where('nama_merk', 'LIKE', '%' . $row['merk'] . '%')->first();
        if ($merk) {
            $id_merk = $merk->id;
        }

        $satuan = Satuan::where('nama_satuan', 'LIKE', '%' . $row['satuan'] . '%')
            ->first();
        if ($satuan) {
            $id_satuan = $satuan->id;
        }

        $tipeBarang = TipeBarang::where('tipe_barang', 'LIKE', '%' . $row['tipe_barang'] . '%')
            ->first();

        if ($tipeBarang) {
            $id_tipe_barang = $tipeBarang->id;
        }

        $barang = Barang::where('nomor', $row['sku'])->first();
        if($barang){
            $barang->update([
                'nama' => $row['nama'],
                'stock' => $row['stock'],
                'min_stock' => $row['min_stock'],
                'harga' => $row['harga'],
                'harga_modal' => $row['harga_modal'],
                'id_merk' => isset($id_merk) ? $id_merk : null,
                'id_satuan' => isset($id_satuan) ? $id_satuan : 0,
                'id_tipe_barang' => isset($id_tipe_barang) ? $id_tipe_barang : 0,
                'deskripsi' => $row['deskripsi'],
                'version' => $row['version'],
            ]);
        }else{
            return new Barang([
                'nama' => $row['nama'],
                'stock' => $row['stock'],
                'min_stock' => $row['min_stock'],
                'harga' => $row['harga'],
                'harga_modal' => $row['harga_modal'],
                'id_merk' => isset($id_merk) ? $id_merk : null,
                'id_satuan' => isset($id_satuan) ? $id_satuan : 0,
                'id_tipe_barang' => isset($id_tipe_barang) ? $id_tipe_barang : 0,
                'deskripsi' => $row['deskripsi'],
                'version' => $row['version'],
                'nomor' => $row['sku']
            ]);
        }

    }

    public function rules(): array
    {
        return [
            'sku' => 'required|string',
            'nama' => 'required|string',
            'stock' => 'required|numeric',
            'min_stock' => 'required|numeric',
            'harga' => 'required|numeric',
            'harga_modal' => 'required|numeric',
            'merk' => 'nullable|string',
            'satuan' => 'required|string',
            'tipe_barang' => 'required|string',
            'deskripsi' => 'nullable|string',
            'version' => 'nullable|numeric',
        ];
    }

    public function customValidationMessages()
    {
        return [
            'nama.required' => 'Nama tidak boleh kosong',
            'nama.string' => 'nama tidak valid !',
            'sku.required' => 'SKU tidak boleh kosong',
            'sku.string' => 'SKU tidak vaild !',
            'stock.required' => 'Stock tidak boleh kosong',
            'stock.numeric' => 'Stock tidak valid !',
            'min_stock.required' => 'Minimal stock tidak boleh kosong',
            'min_stock.numeric' => 'Minimal stock tidak valid !',
            'harga.required' => 'Harga tidak boleh kosong',
            'harga.numeric' => 'Harga tidak valid !',
            'harga_modal.required' => 'Harga modal tidak boleh kosong',
            'harga_modal.numeric' => 'Harga modal tidak valid !',
            'merk.string' => 'Merk tidak valid !',
            'satuan.required' => 'Satuan tidak boleh kosong',
            'satuan.string' => 'Satuan tidak valid !',
            'tipe_barang.required' => 'Tipe barang tidak boleh kosong',
            'tipe_barang.string' => 'Tipe barang valid !',
            'deskripsi.string' => 'Deskripsi tidak valid !',
            'version.numeric' => 'Version tidak valid !',
        ];
    }
}
