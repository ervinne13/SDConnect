<?php

namespace App\Providers;

use App\Services\Impl\JWTAuthServiceDefaultImpl;
use App\Services\JWTAuthService;
use Illuminate\Support\ServiceProvider;

class JWTAuthServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(JWTAuthService::class, JWTAuthServiceDefaultImpl::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [JWTAuthService::class];
    }

}
