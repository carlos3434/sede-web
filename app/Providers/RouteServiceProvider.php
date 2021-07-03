<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * The path to the "home" route for your application.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        Route::model('configuracione', \App\Models\Settings\Configuracion::class);
        Route::model('convocatoria', \App\Models\Settings\Convocatoria::class);
        Route::model('grado', \App\Models\Settings\Grado::class);
        Route::model('institucione', \App\Models\Settings\Institucion::class);
        Route::model('tipocapacitacion', \App\Models\Settings\TipoCapacitacion::class);
        Route::model('tipodocumento', \App\Models\Settings\TipoDocumento::class);
        Route::model('tipoinstitucion', \App\Models\Settings\TipoInstitucion::class);

        Route::model('formacione', \App\Models\RegistroAdhoc\Formacion::class);
        Route::model('capacitacione', \App\Models\RegistroAdhoc\Capacitacion::class);
        Route::model('experiencias-generale', \App\Models\RegistroAdhoc\ExperienciaGeneral::class);
        Route::model('experiencias-inspectore', \App\Models\RegistroAdhoc\ExperienciaInspector::class);
        Route::model('verificaciones-realizada', \App\Models\RegistroAdhoc\VerificacionRealizada::class);
        Route::model('documento', \App\Models\Auth\User::class);

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }
}
