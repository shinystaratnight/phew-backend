<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Database\Eloquent\ModelNotFoundException as ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Debug\Exception\FatalThrowableError;
use Illuminate\Database\Eloquent\MassAssignmentException;

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
     * @param  \Exception  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Exception
     */
    public function render($request, Exception $exception)
    {
        if ($request->expectsJson() && request()->is('api/*')) {
            app()->setLocale($request->header('lang'));
            if ($exception instanceof ModelNotFoundException && $request->wantsJson()) {
                return response()->json([
                    'status' => 'false',
                    'message' => trans('app.exceptions.no_record_found'),
                    'data' => null
                ], 404);
            }
            if ($exception instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                return response()->json([
                    'status' => 'false',
                    'message' => trans('app.exceptions.jwt.token_expired_exception'),
                    'data' => null
                ], $exception->getStatusCode());
            }
            if ($exception instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                return response()->json([
                    'status' => 'false',
                    'message' => trans('app.exceptions.jwt.token_invalid_exception'),
                    'data' => null
                ], $exception->getStatusCode());
            }
            if ($exception instanceof \Tymon\JWTAuth\Exceptions\JWTException) {
                return response()->json([
                    'status' => 'false',
                    'message' => trans('app.exceptions.jwt.jwt_exception'),
                    'data' => null
                ], $exception->getStatusCode());
            }
            if ($exception instanceof UnauthorizedHttpException) {
                return response()->json([
                    'status' => 'false',
                    'message' => trans('app.exceptions.jwt.token_unauthorized'),
                    'data' => null
                ], $exception->getStatusCode());
            }
            if (
                $exception instanceof \ErrorException || $exception instanceof MassAssignmentException
                || $exception instanceof NotFoundHttpException || $exception instanceof FatalThrowableError
                || $exception instanceof \ReflectionException
            ) {
                return response()->json([
                    'status' => 'false',
                    'message' => trans('app.exceptions.not_found_exception'),
                    'data' => null
                ], 500);
            }
        }
        return parent::render($request, $exception);
    }
}
