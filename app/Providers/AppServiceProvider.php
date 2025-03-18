<?php

namespace App\Providers;

use Illuminate\Support\Facades\Validator;
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
        // Menambahkan aturan validasi kustom bernama 'recaptcha' menggunakan metode validate pada kelas ReCaptcha
        Validator::extend('recaptcha', 'App\validator\ReCaptcha@validate');
    }

}
