<?php

namespace App\Providers;

use App\Modules\System\Auth\Services\Impl\JWTAuthServiceDefaultImpl;
use App\Modules\System\Auth\Services\JWTAuthService;
use Illuminate\Support\ServiceProvider;

class JWTAuthServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

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
