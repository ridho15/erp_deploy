<?php

namespace Database\Seeders;

use App\Models\FormMaster;
use Illuminate\Database\Seeder;

class FormMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FormMaster::updateOrCreate([
            'id' => 1
        ], [
            'kode' => 'EC0',
            'nama' => 'Emergency Call',
            'periode' => 0,
            'keterangan' => 'Form Khusus'
        ]);
    }
}
