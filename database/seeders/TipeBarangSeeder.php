<?php

namespace Database\Seeders;

use App\Models\TipeBarang;
use Illuminate\Database\Seeder;

class TipeBarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipeBarang::updateOrCreate([
            'id' => 1
        ], [
            'id' => 1,
            'tipe_barang' => 'Tools',
        ]);

        TipeBarang::updateOrCreate([
            'id' => 2
        ], [
            'id' => 2,
            'tipe_barang' => 'Spareparts',
        ]);

        TipeBarang::updateOrCreate([
            'id' => 3
        ], [
            'id' => 3,
            'tipe_barang' => 'Consumable',
        ]);
    }
}
