<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repositories\Auth\UserRepository;
use App\Repositories\Auth\Interfaces\UserRepositoryInterface;
use App\Repositories\Settings\ConfiguracionRepository;
use App\Repositories\Settings\Interfaces\ConfiguracionRepositoryInterface;

use App\Repositories\AbstractRepository;
use App\Repositories\RepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind( ConfiguracionRepositoryInterface::class ,ConfiguracionRepository::class );
        $this->app->bind( UserRepositoryInterface::class , UserRepository::class   );
        $this->app->bind( RepositoryInterface::class, AbstractRepository::class );

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
