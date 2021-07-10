<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

//Settings
use App\Repositories\Auth\UserRepository;
use App\Repositories\Auth\RoleRepository;
use App\Repositories\Auth\PermissionRepository;
use App\Repositories\Auth\Interfaces\UserRepositoryInterface;
use App\Repositories\Auth\Interfaces\RoleRepositoryInterface;
use App\Repositories\Auth\Interfaces\PermissionRepositoryInterface;

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

//RegistroAdhoc
use App\Repositories\RegistroAdhoc\FormacionRepository;
use App\Repositories\RegistroAdhoc\Interfaces\FormacionRepositoryInterface;
use App\Repositories\RegistroAdhoc\CapacitacionRepository;
use App\Repositories\RegistroAdhoc\Interfaces\CapacitacionRepositoryInterface;
use App\Repositories\RegistroAdhoc\ExperienciaGeneralRepository;
use App\Repositories\RegistroAdhoc\Interfaces\ExperienciaGeneralRepositoryInterface;
use App\Repositories\RegistroAdhoc\ExperienciaInspectorRepository;
use App\Repositories\RegistroAdhoc\Interfaces\ExperienciaInspectorRepositoryInterface;
use App\Repositories\RegistroAdhoc\VerificacionRealizadaRepository;
use App\Repositories\RegistroAdhoc\Interfaces\VerificacionRealizadaRepositoryInterface;

use App\Repositories\SeleccionAdhoc\CalificacionRepository;
use App\Repositories\SeleccionAdhoc\Interfaces\CalificacionRepositoryInterface;
use App\Repositories\SeleccionAdhoc\PuntajeRepository;
use App\Repositories\SeleccionAdhoc\Interfaces\PuntajeRepositoryInterface;

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
        //Auth
        $this->app->bind( UserRepositoryInterface::class , UserRepository::class );
        $this->app->bind( RoleRepositoryInterface::class , RoleRepository::class );
        $this->app->bind( PermissionRepositoryInterface::class , PermissionRepository::class );


        //Settings
        $this->app->bind( ConfiguracionRepositoryInterface::class ,ConfiguracionRepository::class );
        $this->app->bind( ConvocatoriaRepositoryInterface::class, ConvocatoriaRepository::class );
        $this->app->bind( GradoRepositoryInterface::class, GradoRepository::class );
        $this->app->bind( InstitucionRepositoryInterface::class, InstitucionRepository::class );
        $this->app->bind( TipoCapacitacionRepositoryInterface::class, TipoCapacitacionRepository::class );
        $this->app->bind( TipoDocumentoRepositoryInterface::class, TipoDocumentoRepository::class );
        $this->app->bind( TipoInstitucionRepositoryInterface::class, TipoInstitucionRepository::class );
        //RegistroAdhoc
        $this->app->bind( FormacionRepositoryInterface::class, FormacionRepository::class );
        $this->app->bind( CapacitacionRepositoryInterface::class, CapacitacionRepository::class );
        $this->app->bind( ExperienciaGeneralRepositoryInterface::class, ExperienciaGeneralRepository::class );
        $this->app->bind( ExperienciaInspectorRepositoryInterface::class, ExperienciaInspectorRepository::class );
        $this->app->bind( VerificacionRealizadaRepositoryInterface::class, VerificacionRealizadaRepository::class );
        $this->app->bind( CalificacionRepositoryInterface::class, CalificacionRepository::class );

        //Selección verificadores Adhoc
        $this->app->bind( PuntajeRepositoryInterface::class, PuntajeRepository::class );
        //Registro de expediente Adhoc

        //Revisión de expediente Adhoc

        //Diligencia y formulación del informe Adhoc

        //Notificación del informe Adhoc

        //Recepcion y descarga del informe Adhoc

        //Reportes

        //abstract
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
