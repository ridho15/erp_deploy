<?php

namespace Database\Seeders;

use App\Models\WebConfig;
use Illuminate\Database\Seeder;

class WebConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        WebConfig::updateOrCreate([
            'type' => 'web_name'
        ], [
            'type' => 'web_name',
            'value' => '-'
        ]);

        WebConfig::updateOrCreate([
            'type' => 'web_description'
        ], [
            'type' => 'web_description',
            'value' => '-'
        ]);

        WebConfig::updateOrCreate([
            'type' => 'web_phone'
        ], [
            'type' => 'web_phone',
            'value' => '-'
        ]);

        WebConfig::updateOrCreate([
            'type' => 'web_email'
        ], [
            'type' => 'web_email',
            'value' => '-'
        ]);

        WebConfig::updateOrCreate([
            'type' => 'web_faksimili'
        ], [
            'type' => 'web_faksimili',
            'value' => '-'
        ]);

        WebConfig::updateOrCreate([
            'type' => 'web_logo_perusahaan'
        ], [
            'type' => 'web_logo_perusahaan',
            'value' => '-'
        ]);

        WebConfig::updateOrCreate([
            'type' => 'web_alamat'
        ], [
            'type' => 'web_alamat',
            'value' => '-'
        ]);

        WebConfig::updateOrCreate([
            'type' => 'web_logo'
        ], [
            'type' => 'web_logo',
            'value' => '-'
        ]);
    }
}
