<?php

namespace Database\Seeders;

use App\Models\TipeUser;
use Illuminate\Database\Seeder;

class TipeUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipeUser::updateOrCreate([
            'id' => 1
        ], [
            'id' => 1,
            'nama_tipe' => 'Super Admin'
        ]);

        TipeUser::updateOrCreate([
            'id' => 2
        ], [
            'id' => 2,
            'nama_tipe' => 'Admin Gudang'
        ]);

        TipeUser::updateOrCreate([
            'id' => 3
        ], [
            'id' => 3,
            'nama_tipe' => 'Admin Purchase'
        ]);

        TipeUser::updateOrCreate([
            'id' => 3
        ], [
            'id' => 3,
            'nama_tipe' => 'Manager'
        ]);

        TipeUser::updateOrCreate([
            'id' => 4
        ], [
            'id' => 4,
            'nama_tipe' => 'Worker'
        ]);
    }
}
