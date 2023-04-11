<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            TipePerubahanStockSeeder::class,
            TipeUserSeeder::class,
            UserAdminSeeder::class,
            TipePembayaranSeeder::class,
            FormMasterSeeder::class,
            TipeBarangSeeder::class,
            WebConfigSeeder::class,
        ]);
    }
}
