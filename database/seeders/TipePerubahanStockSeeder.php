<?php

namespace Database\Seeders;

use App\Models\TipePerubahanStock;
use Illuminate\Database\Seeder;

class TipePerubahanStockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipePerubahanStock::updateOrCreate([
            'id' => 1
        ],[
            'id' => 1,
            'nama_tipe_perubahan' => 'Dipinjam',
            'badge' => '<span class="badge badge-warning">Dipinjam</span>'
        ]);

        TipePerubahanStock::updateOrCreate([
            'id' => 2
        ],[
            'id' => 2,
            'nama_tipe_perubahan' => 'Dikembalikan',
            'badge' => '<span class="badge badge-success">Dikembalikan</span>'
        ]);

        TipePerubahanStock::updateOrCreate([
            'id' => 3
        ],[
            'id' => 3,
            'nama_tipe_perubahan' => 'Masuk',
            'badge' => '<span class="badge badge-info">Masuk</span>'
        ]);

        TipePerubahanStock::updateOrCreate([
            'id' => 4
        ],[
            'id' => 4,
            'nama_tipe_perubahan' => 'Terjual',
            'badge' => '<span class="badge badge-success">Terjual</span>'
        ]);
    }
}
