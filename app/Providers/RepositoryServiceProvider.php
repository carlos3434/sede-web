<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repositories\Auth\UserRepository;
use App\Repositories\Auth\Interfaces\UserRepositoryInterface;
use App\Repositories\Settings\ConfiguracionRepository;
use App\Repositories\Settings\Interfaces\ConfiguracionRepositoryInterface;
use App\Repositories\Settings\ConvocatoriaRepository;
use App\Repositories\Settings\Interfaces\ConvocatoriaRepositoryInterface;
use App\Repositories\Settings\GradoRepository;
use App\Repositories\Settings\Interfaces\GradoRepositoryInterface;
use App\Repositories\Settings\InstitucionRepository;
use App\Repositories\Settings\Interfaces\InstitucionRepositoryInterface;
use App\Repositories\Settings\TipoCapacitacionRepository;
use App\Repositories\Settings\Interfaces\TipoCapacitacionRepositoryInterface;
use App\Repositories\Settings\TipoDocumentoRepository;
use App\Repositories\Settings\Interfaces\TipoDocumentoRepositoryInterface;
use App\Repositories\Settings\TipoInstitucionRepository;
use App\Repositories\Settings\Interfaces\TipoInstitucionRepositoryInterface;

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
        
        $this->app->bind( ConvocatoriaRepositoryInterface::class, ConvocatoriaRepository::class );
        $this->app->bind( GradoRepositoryInterface::class, GradoRepository::class );
        $this->app->bind( InstitucionRepositoryInterface::class, InstitucionRepository::class );
        $this->app->bind( TipoCapacitacionRepositoryInterface::class, TipoCapacitacionRepository::class );
        $this->app->bind( TipoDocumentoRepositoryInterface::class, TipoDocumentoRepository::class );
        $this->app->bind( TipoInstitucionRepositoryInterface::class, TipoInstitucionRepository::class );

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
