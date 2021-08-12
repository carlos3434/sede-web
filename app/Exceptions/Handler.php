<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Auth\AuthenticationException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof \Illuminate\Database\Eloquent\ModelNotFoundException)
        {
            return response()->json(['message' => 'Recurso para '.str_replace('App\\', '', $exception->getModel()).' no encontrado'], 404);
        }
        if ($exception instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException) {
            \Log::error('NotFoundHttpException Route: ' . \Request::url() );
            return response()->json(['message' => 'Ruta no encontrada!'], 404);
        }
        if ($exception instanceof TokenMismatchException) {
            return response()->json(['message' => 'Falta el token CSRF.'], 419);
        }
        if ($exception instanceof \Illuminate\Validation\ValidationException) {
            return response()->json([
                'message' => 'Los datos proporcionados no son válidos',
                'errors' => $exception->validator->getMessageBag()
            ], 422);
        }
        if ($exception instanceof \Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException ) {
            return response()->json(['message' => $e->getMessage()], 405);
        }
        if ($exception instanceof \Spatie\Permission\Exceptions\UnauthorizedException) {
            return response()->json(['message' => 'El usuario no tiene ninguno necesarios accesos.'], 403);
        }
        return parent::render($request, $exception);
    }
    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        return response()->json([
                "errors" =>  "Solicitud no válida",
                "message" => "El token de acceso no es válido.",
                "hint" => "El token ha caducado"
        ], 401);
    }
}
