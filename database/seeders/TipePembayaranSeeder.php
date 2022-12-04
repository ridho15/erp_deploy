<?php

namespace Database\Seeders;

use App\Models\TipePembayaran;
use Illuminate\Database\Seeder;

class TipePembayaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipePembayaran::updateOrCreate([
            'id' => 1
        ], [
            'nama_tipe' => 'Cash'
        ]);

        TipePembayaran::updateOrCreate([
            'id' => 2
        ], [
            'nama_tipe' => 'Payment Before Work',
        ]);

        TipePembayaran::updateOrCreate([
            'id' => 3
        ], [
            'nama_tipe' => 'Payment After Work',
        ]);

        TipePembayaran::updateOrCreate([
            'id' => 4
        ], [
            'nama_tipe' => 'Cash Before Delivery',
        ]);

        TipePembayaran::updateOrCreate([
            'id' => 5
        ], [
            'nama_tipe' => 'Term Of Payment',
        ]);
    }
}
