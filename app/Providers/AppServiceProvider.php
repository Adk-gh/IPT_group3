<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
  public function boot(): void
{
    // Force HTTPS in production
    if (app()->environment('production')) {
        URL::forceScheme('https');
    }

    // Set application locale
    App::setLocale(Session::get('locale', config('app.locale')));
}


}
