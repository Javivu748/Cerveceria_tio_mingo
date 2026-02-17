<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Events\Registered;
use App\Listeners\SendEmailVerificationNotification;
use App\Models\Cerveza;
use App\Observers\CervezaObserver;
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
        \Illuminate\Support\Facades\Event::listen(
            Registered::class,
            SendEmailVerificationNotification::class
        );
        Cerveza::observe(CervezaObserver::class);
    }
}
