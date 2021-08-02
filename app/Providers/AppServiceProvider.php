<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Support\Facades\Validator;
//use App\Persona;
//use App\Observers\PersonaObserver;

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
        $this->app->register(RepositoryServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //ersona::observe(PersonaObserver::class);
        Validator::extend('alpha_spaces', function ($attribute, $value) {
            return preg_match('/^[\pL\s]+$/u', $value); 
        });
        Validator::extend('alpha_num_spaces', function ($attribute, $value) {
            return preg_match('/^([-a-z0-9_0-9.;,:áéíóúüñÁÉÍÓÚÜÑ\, ])+$/i', $value);
        });
        Validator::extend('acentos', function ($attribute, $value) {
            return preg_match('/^[a-zA-Z0-9áéíóúüñÁÉÍÓÚÜÑ ]+$/', $value);
        });
        Validator::extend('tipo_documento_identidad', function ($attribute, $value) {
            /*if (request()->get('tipo_documento_pago_id') == TipoDocumentoPago::FACTURA && $value <> TipoDocumentoIdentidad::RUC ) {
                return false;
            }*/
            return true;
        });
        Validator::extend('numero_documento_identidad', function ($attribute, $value) {
            /*if ( request()->get('cliente')['tipo_documento_identidad_id'] == TipoDocumentoIdentidad::DNI && strlen($value) == 8 ) {
                return true;
            }
            if ( request()->get('cliente')['tipo_documento_identidad_id'] == TipoDocumentoIdentidad::RUC && strlen($value) == 11 ) {
                return true;
            }*/
            return false;
        });
        //Schema::defaultStringLength(191);
        //Resource::withoutWrapping();
    }
}
