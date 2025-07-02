<?php

namespace App\Providers;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $acceptLang = Request::header('Accept-Language', 'en');
        $locale = explode(',', $acceptLang)[0]; // Get the first language code
        $locale = str_replace('-', '_', $locale); // Optional: normalize to underscore
        App::setLocale($locale);
    }
}
