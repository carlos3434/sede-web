<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::prefix('v1')->group(function(){
    // en el front tienes que crear dos rutas
    //1 ruta para ingresar el email: GET password/reset
    // esta ruta enviara el email a "password/email" y este enviara un email a la persona

    //2 ruta para ingresar el nuevo password password/reset/{token}
    // esta ruta es para digitar dos password iguales y este debe enviar el token a la ruta "password/reset"
    //el servidor redireccionara a la ruta redirecTo del controlador ResetPasswordController
    //si algo fue mal esto redireccionara ala ruta actual pero con errores, esto se debera modificar
    Route::post('password/email', 'Api\Auth\ForgotPasswordController@sendResetLinkEmail');
    Route::post('password/reset', 'Api\Auth\ResetPasswordController@reset');

    Route::get('/unauthorized', 'Api\Auth\AuthController@unauthorized');
    Route::post('register', 'Api\Auth\AuthController@register');
    Route::post('login', 'Api\Auth\AuthController@login');
    Route::get('listasParaRegistro','Api\Listas\ParaRegistroController@index');

    Route::group(['middleware' => 'auth_passport:api'], function(){

        Route::get('getUser', 'Api\Auth\AuthController@getUser');
        Route::post('logout', 'Api\Auth\AuthController@logout');
        //auth
        Route::apiResource('users','Api\Auth\UserController');
        Route::apiResource('roles','Api\Auth\RoleController');
        Route::apiResource('permissions','Api\Auth\PermissionController');
        //ExpedienteAdhoc

        //RegistroAdhoc
        Route::apiResource('formaciones','Api\RegistroAdhoc\FormacionController');
        Route::apiResource('capacitaciones','Api\RegistroAdhoc\CapacitacionController');
        Route::apiResource('experiencias-generales','Api\RegistroAdhoc\ExperienciaGeneralController');
        Route::apiResource('experiencias-inspectores','Api\RegistroAdhoc\ExperienciaInspectorController');
        Route::apiResource('verificaciones-realizadas','Api\RegistroAdhoc\VerificacionRealizadaController');
        Route::apiResource('documentos','Api\RegistroAdhoc\DocumentoController');
        Route::get('postulacion','Api\RegistroAdhoc\PostulacionController@index');
        //guarda en la tabla calificaciones cuando el usuario adhoc postula a una convocatoria
        Route::post('postulacion','Api\RegistroAdhoc\PostulacionController@store');

        //Selección verificadores Adhoc
        Route::get('calificacion','Api\SeleccionAdhoc\CalificacionController@index');
        Route::get('calificacion/{calificacion}','Api\SeleccionAdhoc\CalificacionController@show');
        Route::apiResource('puntaje','Api\SeleccionAdhoc\PuntajeController');

        Route::get('calificacion/{calificacion}/formaciones','Api\SeleccionAdhoc\CalificacionCategoriesController@formaciones');
        Route::get('calificacion/{calificacion}/capacitaciones','Api\SeleccionAdhoc\CalificacionCategoriesController@capacitaciones');
        Route::get('calificacion/{calificacion}/experiencias-generales','Api\SeleccionAdhoc\CalificacionCategoriesController@experienciasGenerales');
        Route::get('calificacion/{calificacion}/experiencias-inspectores','Api\SeleccionAdhoc\CalificacionCategoriesController@experienciasInspectores');
        Route::get('calificacion/{calificacion}/verificaciones-realizadas','Api\SeleccionAdhoc\CalificacionCategoriesController@verificacionesRealizadas');
        //registro de acreditacion
        Route::post('acreditaciones','Api\SeleccionAdhoc\AcreditacionController@store');
        //calificaciones pendientes
        Route::get('calificacion/{convocatoria}/pendientes','Api\SeleccionAdhoc\CalificacionController@pendientes');
        Route::get('calificacion/{convocatoria}/resultados','Api\SeleccionAdhoc\CalificacionController@resultados');
        Route::get('calificacion/{convocatoria}/acreditaciones','Api\SeleccionAdhoc\CalificacionController@acreditaciones');
        //Registro de expediente Adhoc
        Route::apiResource('expedienteadhoc','Api\RegistroExpedienteAdhoc\ExpedienteAdhocController');
        Route::put('expedienteadhoc/{expedienteadhoc}/solicitar_hoja_tramite','Api\RegistroExpedienteAdhoc\ExpedienteAdhocController@solicitarHojaTramite')->name('expedienteadhoc.solicitar_hoja_tramite');
        Route::put('expedienteadhoc/{expedienteadhoc}/solicitar_verificacion_adhoc','Api\RegistroExpedienteAdhoc\ExpedienteAdhocController@solicitarVerificacionAdhoc')->name('expedienteadhoc.solicitar_verificacion_adhoc');
        Route::delete('expedienteadhoc/{expedienteadhoc}/archivo/{archivo}','Api\RegistroExpedienteAdhoc\ExpedienteAdhocController@destroyArchivo')->name('expedienteadhoc.destroyArchivo');

        //Revisión de expediente Adhoc
        Route::apiResource('entregaexpediente','Api\RevisionExpediente\EntregaExpedienteController');


        //Diligencia y formulación del informe Adhoc

        //Notificación del informe Adhoc

        //Recepcion y descarga del informe Adhoc

        //Reportes
        Route::get('listasParaPostulantesAdhoc','Api\Reportes\PostulantesAdhocController@listas');
        Route::get('reporte/postulantesadhoc','Api\Reportes\PostulantesAdhocController@reporte');

        //Settings

        Route::apiResource('configuraciones','Api\Settings\ConfiguracionController');
        Route::apiResource('convocatorias','Api\Settings\ConvocatoriaController');
        //Route::apiResource('','Api\Settings\Controller');
        //Route::apiResource('','Api\Settings\Controller');
        //Route::apiResource('estadocivil','Api\Settings\EstadoCivilController');
        Route::apiResource('grados','Api\Settings\GradoController');
        Route::apiResource('instituciones','Api\Settings\InstitucionController');
        //Route::apiResource('paises','Api\Settings\PaisController');
        //Route::apiResource('','Api\Settings\Controller');
        //Route::apiResource('sederegistral','Api\Settings\SedeRegistralController');
        Route::apiResource('tipocapacitacion','Api\Settings\TipoCapacitacionController');
        Route::apiResource('tipodocumento','Api\Settings\TipoDocumentoController');
        Route::apiResource('tipoinstitucion','Api\Settings\TipoInstitucionController');
        //Route::apiResource('tiponivel','Api\Settings\TipoNivelController');

        //listas
        Route::get('listasParaInstitucion','Api\Listas\ParaInstitucionController@index');
        Route::get('listasParaFormacion','Api\Listas\ParaFormacionController@index');
        Route::get('listasParaCapacitacion','Api\Listas\ParaCapacitacionController@index');
        Route::get('listasParaExperienciaGeneral','Api\Listas\ParaExperienciaGeneralController@index');
        Route::get('listasParaExperienciaInspector','Api\Listas\ParaExperienciaInspectorController@index');
        Route::get('listasParaVerificacionRealizada','Api\Listas\ParaVerificacionRealizadaController@index');
        Route::get('listasParaPostulacion','Api\Listas\ParaPostulacionController@index');
        Route::get('listasParaCalificacion','Api\Listas\ParaCalificacionController@index');

        Route::get('listasParaPuntaje','Api\Listas\ParaPuntajeController@index');
        Route::get('listasParaSolicitarHojaTramite','Api\Listas\ParaEstadosExpedienteAdhocController@hojaTramite');
        Route::get('listasParaSolicitarVerificacion','Api\Listas\ParaEstadosExpedienteAdhocController@verificacion');
        //Route::get('listasParaPuntaje','Api\Listas\ParaPuntajeController@index');

        //documentos 
        // http://{{domain}}/api/v1/files/cv/1624854166.pdf
        Route::get('files/constancias/{path}', function ($path) {
            $pathToFile = storage_path('app/uploads/files/constancias/'.$path);
            return response()->file($pathToFile);
        });
        Route::get('files/declaraciones/{path}', function ($path) {
            $pathToFile = storage_path('app/uploads/files/declaraciones/'.$path);
            return response()->file($pathToFile);
        });
        Route::get('files/dni/{path}', function ($path) {
            $pathToFile = storage_path('app/uploads/files/dni/'.$path);
            return response()->file($pathToFile);
        });
        Route::get('files/rj_itse/{path}', function ($path) {
            $pathToFile = storage_path('app/uploads/files/rj_itse/'.$path);
            return response()->file($pathToFile);
        });
        Route::get('files/rj_verificador/{path}', function ($path) {
            $pathToFile = storage_path('app/uploads/files/rj_verificador/'.$path);
            return response()->file($pathToFile);
        });
        Route::get('files/anexo_1/{path}', function ($path) {
            $pathToFile = storage_path('app/uploads/files/anexo_1/'.$path);
            return response()->file($pathToFile);
        });
        Route::get('files/fotos/{path}', function ($path) {
            $pathToFile = storage_path('app/uploads/files/fotos/'.$path);
            return response()->file($pathToFile);
        });
        Route::get('files/formacion/{path}', function ($path) {
            $pathToFile = storage_path('app/uploads/files/formacion/'.$path);
            return response()->file($pathToFile);
        });
        //capacitaciones
        Route::get('files/capacitacion/{path}', function ($path) {
            $pathToFile = storage_path('app/uploads/files/capacitacion/'.$path);
            return response()->file($pathToFile);
        });
        //experienciaGeneral
        Route::get('files/experienciaGeneral/{path}', function ($path) {
            $pathToFile = storage_path('app/uploads/files/experienciaGeneral/'.$path);
            return response()->file($pathToFile);
        });
        //experienciaInspector
        Route::get('files/experienciaInspector/{path}', function ($path) {
            $pathToFile = storage_path('app/uploads/files/experienciaInspector/'.$path);
            return response()->file($pathToFile);
        });

        //Expediente adhoc
        Route::get('files/recibo_pago/{path}', function ($path) {
            return response()->file( storage_path('app/uploads/files/recibo_pago/'.$path) );
        });
        Route::get('files/archivo_solicitud_ht/{path}', function ($path) {
            return response()->file( storage_path('app/uploads/files/archivo_solicitud_ht/'.$path) );
        });
        Route::get('files/expediente_adhoc_archivos/{path}', function ($path) {
            return response()->file( storage_path('app/uploads/files/expediente_adhoc_archivos/'.$path) );
        });
        /*
        Route::get('files/carta_poder_simple/{path}', function ($path) {
            return response()->file( storage_path('app/uploads/files/carta_poder_simple/'.$path) );
        });
        Route::get('files/copia_vigencia_poder/{path}', function ($path) {
            return response()->file( storage_path('app/uploads/files/copia_vigencia_poder/'.$path) );
        });
        Route::get('files/copia_partida_registral/{path}', function ($path) {
            return response()->file( storage_path('app/uploads/files/copia_partida_registral/'.$path) );
        });
        Route::get('files/copia_dni_propietario/{path}', function ($path) {
            return response()->file( storage_path('app/uploads/files/copia_dni_propietario/'.$path) );
        });
        Route::get('files/recibo_pago/{path}', function ($path) {
            return response()->file( storage_path('app/uploads/files/recibo_pago/'.$path) );
        });
        Route::get('files/copia_formulario_for/{path}', function ($path) {
            return response()->file( storage_path('app/uploads/files/copia_formulario_for/'.$path) );
        });
        Route::get('files/informe_tecnico_verificador_responsable/{path}', function ($path) {
            return response()->file( storage_path('app/uploads/files/informe_tecnico_verificador_responsable/'.$path) );
        });
        Route::get('files/esquela_observacion_sunarp/{path}', function ($path) {
            return response()->file( storage_path('app/uploads/files/esquela_observacion_sunarp/'.$path) );
        });
        Route::get('files/memoria_descriptiva_seguridad/{path}', function ($path) {
            return response()->file( storage_path('app/uploads/files/memoria_descriptiva_seguridad/'.$path) );
        });
        Route::get('files/certificado_pozo_tierra/{path}', function ($path) {
            return response()->file( storage_path('app/uploads/files/certificado_pozo_tierra/'.$path) );
        });
        Route::get('files/certificado_laminados/{path}', function ($path) {
            return response()->file( storage_path('app/uploads/files/certificado_laminados/'.$path) );
        });
        Route::get('files/certificado_sistema_electrico/{path}', function ($path) {
            return response()->file( storage_path('app/uploads/files/certificado_sistema_electrico/'.$path) );
        });*/

    });
});
