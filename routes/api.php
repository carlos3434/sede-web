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
        Route::apiResource('calificacion','Api\SeleccionAdhoc\CalificacionController');
        Route::apiResource('puntaje','Api\SeleccionAdhoc\PuntajeController');
        //Registro de expediente Adhoc

        //Revisión de expediente Adhoc

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

        Route::get('listasParaPuntaje','Api\Listas\ParaPuntajeController@index');

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

    });
});
