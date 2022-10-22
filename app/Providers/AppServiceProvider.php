<?php

namespace App\Providers;

use App\CPU\Helpers;
use App\Models\WebConfig;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        try {
            $web = WebConfig::all();
            $web_config = [
                'web_logo' => Helpers::getSetting($web, 'logo'),
                'web_name' => Helpers::getSetting($web, 'judul'),
                'favicon' => Helpers::getSetting($web, 'favicon'),
                'logo_perusahaan' => Helpers::getSetting($web, 'logo_perusahaan'),
                'nama_perusahaan' => Helpers::getSetting($web, 'name'),
            ];

            View::share(['web_config' => $web_config]);
        } catch (\Exception $e) {
        }
    }
}
